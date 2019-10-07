/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });
$(document).ready(function() {
    // Setup ajax to take csrf token so that forms can be correctly
    // to backend
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("#checkUsersButton").click(function() {
        const email = $("#email");
        const errorMessage = $("#errorMessage");
        if (email.val() === "") {
            // Add red border to input if no email is provided
            email.css("border", function() {
                return "1px solid red";
            });

            // Display error message
            errorMessage.show();
        } else {
            // Put back default border
            email.css("border", function() {
                return "1px solid #ced4da";
            });
            errorMessage.hide();

            $.ajax({
                url: "/conversation/findUserByEmail",
                type: "post",
                data: {
                    email: email.val()
                },
                success: function(response) {
                    $("#userResultTable").html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    $(document).on("click", '[name="addUserToConversationButton"]', function() {
        const userId = $(this).data("id");
        sessionStorage.setItem("userId", userId);
    });

    $(document).on("click", "#createConversation", function() {
        const userId = sessionStorage.getItem("userId");
        const name = $("#conversationName").val();
        $.ajax({
            url: "/conversation/create",
            type: "post",
            data: {
                name: name,
                userId: userId
            },
            success: function(response) {
                if (response["status"] == 200) {
                    window.location.href = "/conversation/" + response["id"];
                } else {
                    window.location.href = "/conversation/";
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Uncomment to enable tooltips
    // $(function() {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
});
