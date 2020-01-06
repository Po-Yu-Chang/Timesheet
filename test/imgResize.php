<?php
	function imgResize($src,$newSrc,$whLimit) { 
		//確認檔案存在，並且定義了圖檔儲存路徑後，才進行下述動作
		if (file_exists($src) && isset($newSrc)) { 
		//變數$srcInfo取得來源圖片資料陣列值
		$srcInfo = getimagesize($src); 
		//利用變數$srcInfo的陣列索引值2取得圖片檔案格式，儲存在變數$srcType中
		$srcType = $srcInfo[2];
		//取得來源圖片寬高
		$src_w = $srcInfo[0];
        $src_h = $srcInfo[1];
        // 依據$whLimit自定長寬限制，判斷縮放尺寸
        if($src_w > $src_h){
            $thumb_w = $whLimit;
            $thumb_h = intval($src_h / $src_w * $whLimit);
         }else{
            $thumb_h = $whLimit;
            $thumb_w = intval($src_w / $src_h * $whLimit);
         } 
		//依據$srcType取得之檔案格式，1=GIF、2=JPG、3=PNG，不同格式使用對應函數讀取圖檔
		switch ($srcType) {
			 case 1:$src = imagecreatefromgif($src);break;
             case 2:$src = imagecreatefromjpeg($src);break;
             case 3:$src = imagecreatefrompng($src);break;
		   } 
        // 依據判片後縮圖尺寸，產生出一個準備要放置縮圖的彩色空白圖像
        $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		//利用下面2個函數保留PNG圖檔透明效果
		imagealphablending($thumb,false);
		imagesavealpha($thumb,true);
        // 重新採樣並調整大小後拷貝圖像到另一個圖像中，也就是開始縮圖
        imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
        // 不同格式圖檔將使用對應的函數輸出圖檔，接著儲存縮圖到指定位置，數值100為圖檔品質，可自行調整
		switch ($srcType) {
             case 1:imagegif($thumb, $newSrc);break;
             case 2:imagejpeg($thumb, $newSrc,100);break;
			 case 3:imagepng($thumb,$newSrc); break;
		   }
		//釋放和圖形關聯的記憶體	
		imagedestroy($thumb);		
		} 		
	}
?>