<template>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<!--<div> -->

<!--
<div v-if=" $store.state.token == '' ">
  
  <nuxt/>
  
</div>
-->

<div class="hold-transition skin-blue sidebar-mini  "  > 

<!-- <div class="flex-box">flex-box</div> -->

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <nuxt-link to="/" class="logo">
<!--    <a href="/" class="logo">-->
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"> CRM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Marka</b>CRM</span>
<!--    </a>-->
    </nuxt-link>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a  class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
 

          <!-- Notifications Menu -->
<!--
          <li class="dropdown notifications-menu"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                 
                <ul class="menu">
                  <li> 
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li> 
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
-->
          <!-- Tasks Menu -->
<!--
          <li class="dropdown tasks-menu"> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li> 
                    <a href="#">
                       
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      
                      <div class="progress xs">
                         
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                   
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
-->
          <!-- User Account Menu -->
          <li> 
           <nuxt-link to="/user">{{ $store.getters['user/item'].name }}</nuxt-link> 
          </li>
          
          <li><a href="#" @click.prevent="signout">Выйти</a></li>
          <!-- Control Sidebar Toggle Button -->
<!--
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
-->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
<!--
      <div class="user-panel">
        <div class="pull-left image">
          <img src="http://placehold.it/160" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
           
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
-->

      <!-- search form (Optional) -->
<!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Основное</li>
        <!-- Optionally, you can add icons to the links -->
  
        <li> 
          <nuxt-link to="/users/"><i class="fa fa-link"></i> <span>Пользователи</span></nuxt-link>
        </li>
          
<!--
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
-->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <nuxt/>
 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
<!--
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
-->
    <!-- Default to the left -->
<!--    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<!--<script src="/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<!-- Bootstrap 3.3.6 -->
<!--<script src="/AdminLTE/bootstrap/js/bootstrap.min.js"></script>-->
<!-- AdminLTE App -->
<!--<script src="/AdminLTE/dist/js/app.min.js"></script>-->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
     
</div>
    
<!--</div>-->
     
</template>
 
<script>
  
import _ from 'lodash' 
  
import Vue from 'vue'  
import axios from '~plugins/axios'
  
import auth_init from '~plugins/auth_init'
  
Vue.mixin({
  computed: {
    _() {
      return _;
    } 
  }
})
  
 
  
export default { 
   
mounted( ){
  
  auth_init(this.$store, this.$router)
    
  if ( _.isEmpty( this.$store.getters['users/list'] ) ){
    this.$store.dispatch('users/get')
  }  
  
  if ( _.isEmpty( this.$store.getters['roles/list'] ) ){
    this.$store.dispatch('roles/get')
  }
 
   
},
methods: {
    signout(){
      console.log('signout')
      
      this.$store.commit('user/drop')  
      
      this.$router.push('/auth/signin')
    }
}
    
}
</script>