var app = new Vue({
    el:".main-body",
    data: {
        errorMsg : "",
        errorFlag : false,
        newuser : { user_id : "", password : "" }
    },

    methods: {
        
        LoginAccess:function(){
            var FormUser = app.toFormData(app.newuser);
            
            axios.post("http://localhost/Admission/Backend/BK_Login_Access.php", FormUser)
            .then(function(res){
                if(res.data.msg=="access"){
                    //console.log(res.data.ID);
                    return location.href = "Page_Dashboard.html?Admin="+res.data.ID;
                }
                else {
                    app.errorFlag = true;
                    app.errorMsg = res.data.msg;
                }
                //return console.log(res.data);
            });
            
        },

        toFormData:function(obj){
            var form_data = new FormData();
            for( var key in obj ){
                form_data.append(key, obj[key]);
            }
            return form_data;
        }
    }
});