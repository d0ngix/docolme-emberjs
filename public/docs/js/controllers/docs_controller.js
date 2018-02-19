Docs.DocsController = Ember.ArrayController.extend({
    isEdit: false,    

    username: window.sessionStorage.getItem("username"),
    uid: window.sessionStorage.getItem('uid'),
    
    actions : {
        // createDoc : function () {
        //     this.set('isEdit', true);
        // },
        createDoc : function () {
            
            var fileName = this.get('fileName');
            if (!fileName.trim()) { return; }

            var content = this.get('content');
            if (!content.trim()) { return; }

            var userId = uid;

            var doc = this.store.createRecord('doc', {
                fileName: fileName,
                content: content,
                userId: userId
            });

            todo.save();            

        },

        createCancel : function () {

        },
        shit: function () {
            return 'shit';
          }.property('shit'),        


    }
});