Docs.UsersLoginController = Ember.ObjectController.extend({
    loginFailed : false,

    actions : {
        signin :  function (model) {
            self = this;
        
            window.sessionStorage.removeItem('username');
            window.sessionStorage.removeItem('uid');                

            username = this.get('model.username');
            if (!username.trim()) { return; }

            $.post("http://localhost:8888/docolme-emberjs/public/users/login", {
                username: username
            }).then ( function (response) {
                
                var userDetails = JSON.parse(response);

                if (userDetails.users.username == undefined) {
                    self.set('loginFailed',true);
                    self.set('username', username);
                    //alert('failed');
                    return false;
                }

                window.sessionStorage.setItem('username', userDetails['users']['username']);
                window.sessionStorage.setItem('uid', userDetails['users']['id']);                
                //console.log(userDetails['users']['id']);
                //alert('success')
                document.location = "index.html#/alldocs"                
                
            }, function (controller) {
                self.set('loginFailed',true);
                self.set('username', username);
                //alert('failed')
            });
        },
        create : function (model) {
            // var username = this.controller.get('model.username');
            var _this = this;
            username = this.get('username');
            if (!username.trim()) { return; }

            $.post( "http://localhost:8888/docolme-emberjs/public/users", {
                username: username
            }).then ( function (response) {
                //document.location = "/docs/index.html#/"
                var userDetails = JSON.parse(response);
                window.sessionStorage.setItem('username', userDetails['users']['username']);
                window.sessionStorage.setItem('uid', userDetails['users']['id']);                

                document.location = "index.html#/alldocs"                

                //_this.transitionToRoute('docs/alldocs');
            }, function () {
                //this.set("loginFailed", true)
            });            
            
        }
    }

});