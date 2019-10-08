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
        const name = $(document)
            .find("#conversationName")
            .val();
        console.log(name);
        $.ajax({
            url: "/conversation/create",
            type: "post",
            dataType: "json",
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

    function updateMessageDisplay(elem) {
        const message = elem;
        const message_id = elem.data("id");
        $.ajax({
            url: "/conversation/updateMessage/" + message_id,
            type: "post",
            data: {
                left: message.css("left"),
                top: message.css("top"),
                width: message.css("width"),
                height: message.css("height"),
                zIndex: message.css("zIndex")
            },
            success: function(response) {
                if (response["status"] === 403) {
                    window.location.href = "/conversation/";
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Get max zIndex from all the post-its on the page
    function getzIndexMax() {
        let zIndexMax = 0;
        $(".postit").each(function() {
            if ($(this).css("zIndex") > zIndexMax) {
                zIndexMax = parseInt($(this).css("zIndex"), 10);
            }
        });
        return zIndexMax;
    }

    $(".draggable").draggable({
        stop: function() {
            updateMessageDisplay($(this));
        }
    });
    $(".resizable").resizable({
        stop: function() {
            updateMessageDisplay($(this));
        }
    });

    $("#trash-can").droppable({
        over: function(event, ui) {
            $(ui.draggable).removeClass("draggable");
        },
        out: function(event, ui) {
            $(ui.draggable).addClass("draggable");
        },
        drop: function(event, ui) {
            const message_id = $(ui.draggable).data("id");
            $.ajax({
                url: "/conversation/deleteMessage",
                type: "POST",
                data: {
                    id: message_id
                },
                success: function(response) {
                    if (response["status"] !== 200) {
                        window.location.href = "/conversation/";
                    } else {
                        $(ui.draggable).fadeOut("slow");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // Put post-it on top of all others when clicked or dragged
    $(".postit").on("click", function() {
        let zIndexMax = getzIndexMax();
        $(this).css("zIndex", zIndexMax + 1);
    });

    $(".postit").on("dragstart", function() {
        let zIndexMax = getzIndexMax();
        $(this).css("zIndex", zIndexMax + 1);
    });

    // Uncomment to enable tooltips
    // $(function() {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
});
