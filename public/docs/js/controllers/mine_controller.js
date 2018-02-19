Docs.MineController = Ember.ArrayController.extend({
    isEdit: false,    

    username: window.sessionStorage.getItem("username"),
    uid: window.sessionStorage.getItem('uid'),
    



});