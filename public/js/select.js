new TomSelect("#serie_genres",{
    plugins: ['remove_button'],
    render:{
        option:function(data,escape){
            return '<div class="d-flex"><span>' + escape(data.text);
        },
        item:function(data,escape){
            return '<div>' + escape(data.text) + '</div>';
        }
    }
});
