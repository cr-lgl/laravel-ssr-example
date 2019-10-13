<template>
   <div id="app">
       <div class="container">
           <div class="row justify-content-center">
               <div class="col-md-8">
                   <div class="card">
                       <div class="card-header">Example Component</div>

                       <div class="card-body">
                           I'm an example component.
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
