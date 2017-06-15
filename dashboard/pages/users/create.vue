<template>
  
<div class="content-wrapper">
    
  <section class="content-header">
      <h1>
       Новый пользователь
        <small>Создание нового пользователя</small>
      </h1>
 
      
    </section>
 
    <section class="content">

   <UserCreate/>

    </section>
    
</div>
 
  
</template>


<script>
   
import UserCreate from '~components/Users/UserCreate'

export default {
  
  components: { UserCreate }, 
  
}
</script>