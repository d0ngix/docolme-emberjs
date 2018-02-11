Docs.UsersLoginController = Ember.ObjectController.extend({
    loginFailed : false,

    actions : {
        signin :  function (model) {
            self = this;
            username = this.get('model.username');
            if (!username.trim()) { return; }

            $.post("/users/login", {
                username: username
            }).then ( function (response) {
                self.set('username', username);
                document.location = "/docs/index.html#/"                
                alert('success')
                
            }, function (controller) {
                self.set('loginFailed',true);
                self.set('username', username);
                alert('failed')
            });
        },
        create : function (model) {
            // var username = this.controller.get('model.username');
            username = this.get('username');
            if (!username.trim()) { return; }

            $.post("/users", {
                username: username
            }).then ( function (response) {
                document.location = "/docs/index.html#/"
            }, function () {
                //this.set("loginFailed", true)
            });            
            
        }
    }

});