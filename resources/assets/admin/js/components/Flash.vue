<template>
    <div :class="'alert alert-flash alert-' + newClass" role="alert" v-show="show">
    <!--<div class="alert alert-flash" role="alert" v-show="show">-->
    <!--<div class="alert alert-{{ newClass }} alert-flash" role="alert" v-show="show">-->
        <strong>{{ body }}</strong>
    </div>
</template>

<script>
    export default {
        props: ['message', 'classname'],

        data(){
            return {
                body: this.message,
                newClass: this.classname,
                show: false
            }
        },
        created(){
            if (this.message){
                this.flash(this.message, this.classname);
                console.log(this.message)
            }

            var _this = this;
            window.events.$on('flash', function(message, className) {
                _this.flash(message, className);
            });
        },
        methods: {
            flash(message, classname){
                this.body = message;
                this.show = true;
                this.newClass = classname;

                this.hide();
            },
            hide(){
                    setTimeout(() => {
                        this.show = false;
                }, 4000);
            }
        }
    };
</script>

<style>
    .alert-flash{
        position: fixed;
        padding: 30px;
        right: 45px;
        top: 25px;
    }
</style>