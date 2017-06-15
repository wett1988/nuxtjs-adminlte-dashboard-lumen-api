<template>
  
<div class="content-wrapper">
    
  <section class="content-header">
      <h1>
       Редактирование пользователя
        <small>Обновление данных пользователя</small>
      </h1>
 
      
    </section>
 
    <section class="content">

   <UserEdit/> 
     
    </section>
    
</div>
 
  
</template>


<script>
   
import UserEdit from '~components/Users/UserEdit'

export default {
  
  components: { UserEdit }, 
  
}
</script>