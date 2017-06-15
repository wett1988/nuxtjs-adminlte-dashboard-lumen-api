<template>
<div>
   
<div class="form-horizontal" v-if="edit"> 
               
<div class="form-group" :class="{ 'has-error': errors.raw.name }">
    <label class="col-sm-2 control-label">Имя</label>

    <div class="col-sm-10">
        <input v-model="value.name" class="form-control" placeholder="Введите имя">
        
        <span v-if="errors.raw.name" class="help-block" v-for="error in errors.raw.name">{{ error }}</span>
    </div>
</div> 

<div class="form-group" :class="{ 'has-error': errors.raw.email }">
    
    <label class="col-sm-2 control-label">Почта</label>
      
    <div class="col-sm-10">
        <input v-model="value.email" class="form-control" placeholder="Введите электронную почту">
        
        <span v-if="errors.raw.email" class="help-block" v-for="error in errors.raw.email">{{ error }}</span>
    </div>  
         
</div>
            
<!-- Роли -->
<div class="form-group" v-show="$store.getters['user/isAdmin']" v-if="!_.isUndefined($store.state.roles.list)" :class="{ 'has-error': errors.raw.users_ids}">
   <label class="col-sm-2 control-label">Роли</label>

  <div class="col-sm-10">
    <select v-model="value.roles_ids" class="form-control" multiple>
      <option v-for="opt in $store.getters['roles/list']" :value="opt.id">{{ opt.title }}</option>
    </select>
    
    <span v-if="errors.raw.users_ids" class="help-block" v-for="error in errors.raw.users_ids">{{ error }}</span>
  </div>
</div> 
             
             
              
</div>

<div v-if="!edit"> 

<pre>
  {{ value }}
</pre>
 
</div>
</div>
</template>

<script> 
  
export default { 
  props: ['value', 'edit', 'errors'], 
}

</script>