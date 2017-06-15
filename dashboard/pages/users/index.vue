<template>

<div class="content-wrapper">
    
  <section class="content-header">
<!--
      <h1>
       Пользователи
      <small> 
      <nuxt-link to="/users/create" class="fa fa-plus-circle"></nuxt-link>
      </small> 
      </h1>
-->

<h1>
  
       <div class="row">
         <div class="col-md-11">
          
       Пользователи
      <small> 
        <nuxt-link to="/users/create" class="fa fa-plus-circle" v-show="$store.getters['user/isAdmin']"></nuxt-link>
      </small> 
           
         </div>
<!--
         <div class="col-md-1">
           
      <div class="input-group-btn ">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true" style="margin-right: 10px;"></i> <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right"> 
          <li><a href="#" data-toggle="modal" data-target="#roles">Роли пользователей</a></li> 
        </ul>
      </div> 
           
           
         </div>
-->
       </div> 
  
</h1>
 
      
    </section>
 
    <section class="content">

  
 <UserList/>
 
<!-- Modal -->
<!--
<div id="roles" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Роли</h4>
      </div>
      <div class="modal-body">
        
       <RoleList/>
       
       <RoleCreate/>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>

  </div>
</div>
-->
   
    </section>
    
    
    
</div>
 
 
</template>

<script>
   
import UserList from '~components/Users/UserList'
  
import RoleCreate from '~components/Users/Roles/RoleCreate'
import RoleList from '~components/Users/Roles/RoleList'
 
  
export default {
  
  components: { UserList, RoleList, RoleCreate },
 
}
</script>