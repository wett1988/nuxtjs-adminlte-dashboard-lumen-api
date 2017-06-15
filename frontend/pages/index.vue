<template>
 <div>
  
<div class="container-fluid"> 
<div class="container"   >

Index page
 
</div>
</div>

 </div> 
</template>

 

<script>
  
import axios from 'axios'
 
import Vue from 'vue'
import _ from 'lodash'
  
Vue.mixin({
  computed: {
    _() {
      return _
    },
  }
}) 
  
export default { 
  components: { },
  head: { 
    title:  "wett.pw | Главная страница", 
  },
  data(){
    return {
      posts: []
    }
  },
  mounted(){ 
    
    let vm = this
    
//    axios.all([
//      axios.get('/api/news.json'), 
//      axios.get('/api/articles.json'), 
//      axios.get('/api/videos.json'), 
//    ])
//    .then(axios.spread(function (news_res, articles_res, videos_res) { 
//       
//      vm.news = news_res.data.news 
//      vm.articles = articles_res.data.articles 
//      vm.videos = videos_res.data.videos
//        
//    }))
//    .catch(function (error) {
//      console.log(error)
//    })
    
  }
}
</script>