
<input type="hidden" id="username" value=<?=$this->session->userdata('username');?> >
<input type="hidden" id="id" value=<?=$this->session->userdata('id');?> >
<input type="hidden" id="leavel" value=<?= $id=$this->session->userdata('leavel');?> >
<input type="hidden" id="dept_id" value=<?=$this->session->userdata('dept_id');?> >
<input type="hidden" id="dept" value=<?=$this->session->userdata('dept');?> >
<input type="hidden" id="serial_number" value="1" >
<input type="hidden" id="duty" >



<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo '../?/User/main'?>"><span>CINPHOWN</span></a>        
            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul style=" display: inline-flex;"  class="nav pull-right" >
                    <!-- start: User Dropdown -->
                    
                    <li class="dropdown hidden-phone" id="Default_message"></li>
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?= $username=$this->session->userdata('username');?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                    <span>使用者設定</span>
                            </li>
                            <li><a href="#"><i class="halflings-icon refresh"></i> 身分切換</a></li>
                            <li>
                                <select id="switch_dept" onChange="switch_dept(this.options[this.selectedIndex].text , this.options[this.selectedIndex].value);">
                                    <?php foreach ($_SESSION['dept_array'] as $key => $value): ?>
                                    <option value="<?=$value['dept_id']?>" <?=($value['dept_name']==$_SESSION['dept'])?"selected":"";?>><?=$value['dept_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                            <li><a href="<?= '../?/Account_C'?>"><i class="halflings-icon user"></i> 帳號設定</a></li>
                            <li><a href="<?= '../?/Logout'?>"><i class="halflings-icon off"></i> 登出</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->
        </div>
    </div>
</div>

<input type="hidden" id="baseurl" value="<?= base_url()?>">




