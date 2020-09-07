<template>
   <div id="app">
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">Example</div>

                       <div class="card-body">
                           <router-view></router-view>
                       </div>

                       <div class="card-footer">
                           <router-link :to="{ name: 'home' }">Home</router-link>
                           <router-link :to="{ name: 'about' }">About</router-link>
                           <router-link :to="{ name: 'contact' }">Contact</router-link>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
    export default {
        metaInfo: {
            title: 'PHP Ssr Example',
            meta: [
                {
                    hid: 'description',
                    name: 'description',
                    content: 'Hello World'
                },
            ],
        },
    }
</script>
