﻿Docs.UsersRoute = Ember.Route.extend({
    model: function() {
        return this.store.createRecord('users');
      }
});

Docs.UsersLoginRoute = Ember.Route.extend({
    
    model: function() {
        return this.store.createRecord('users');
      },

    // actions : {
    //     signin :  function () {
    //         username = this.controller.get('username');
    //         if (!username.trim()) { return; }

    //         $.post("/users/login", {
    //             username: username
    //         }).then ( function (response) {
    //             //document.location = "/docs/index.html#/"
    //             alert('success')
    //         }, function () {
    //             alert('failed')
    //         });
    //     },
    //     create : function () {
    //         // var username = this.controller.get('model.username');
    //         username = this.controller.get('username');
    //         if (!username.trim()) { return; }

    //         $.post("/users", {
    //             username: username
    //         }).then ( function (response) {
    //             document.location = "/docs/index.html#/"
    //         }, function () {
    //             //this.set("loginFailed", true)
    //         });            
            
    //     }
    // },
    // setupController: function(controller, model) {
    //     //controller.set('model', model);
    //     controller.set('loginFailed', false);
    // },
    // renderTemplate : function (controller) {
    //     //this.set('fileName', 'TEST!@#');
    //     this.render ('users/login', {controller: controller})
    // },

});



