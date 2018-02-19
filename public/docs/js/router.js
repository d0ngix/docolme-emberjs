
Docs.Router.map( function () {
    this.resource( 'docs', { path: '/' }, function () {
        this.route('edit');
        this.route('create');
        this.route('alldocs');
        this.route('mydocs');
        this.resource('doc', {path: ':doc_id'});
    } ),
    this.resource ('users', function () {
        this.route('login');
    })

    this.resource('mine', function(){
        //this.resource('doc', {path: '/:doc_id'});        
    });
    
    //this.resource('doc', {path: ':doc_id'});    
    
} );


