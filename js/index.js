var no=0;
$(document).ready(function(){
    //creating copy for favourite messages
    var a=$(".fav_show_hide_0");
    console.log(a.length)
    for(let i=0;i<a.length;i++)
        {
            //message id of div box
           let msg_id=a[i].parentNode.parentNode.parentNode.id;
            console.log("in loop");
            console.log(msg_id) ;
            //splitng the id for just id from `messageid` to `id`
            let id=msg_id.split("message");
            //printing the id
            console.log(id[1])
            //creating copy of the message box for favourite
            let elem=$("#"+msg_id).clone();
            //removing the id of message box
            elem.removeAttr("id");
            //creating new id for favourite box
            elem.attr("id","favourite"+id[1]);
            //appending the favourite box in favourite lis
            $("#menu1").append(elem);
        }
    
    
    //sending annonymous message
        $("#submit_msg").click(function(){
            no++;
            if(no>4)
                {
                    $("#comment").before("sorry,there is a problem sending messages");
                }
        else{
             var msg=$("#comment").val();
    var ck_username = /^[A-Z a-z 0-9 \n ]{1,1000}$/;
    if(ck_username.test(msg))
        {
            var msg_new=msg.replace(/\n/g, " <br> ");
            console.log(msg_new)
             $.ajax({
        type:"post",
        url:"./ins_msg.php",
        data:{data:msg_new},
        success:function(event){
            $("#comment").before("Message Sent");
        }
             });
        }
            else
            {
                console.log("error in text");
            }
    
    }
   
    });
     
    });

function validate()
{
    
    var email=$("input[type=email]").val();
    var username=$("#username").val();
    var name=$("#name").val();
    var pass=$("#pass").val();
    var repass=$("#repass").val();
    $(".err_red").text("")
    if(email=="")
        {
       $("#email_err").text("Field must be filled");
        return false;
      
        }
    if(username=="")
        {
            $("#user_err").text("Field must be filled")
            return false;
        }
    if(name=="")
        {
            $("#name_err").text("Field must be filled")
            return false;
        }
    if(pass=="")
        {
            $("#pass_err").text("Field must be filled")
            return false;
        }
    if(pass!=repass)
        {
            $("#repass_err").text("password did't matched please try again")
            return false;
        }
    return true;
}



  function favourite(id,This)
    {
        
        console.log("add_fav function called");
        if($("#"+This).hasClass("fav_show_hide_1"))
        {
            $.ajax({
                type:"post",
                url:"../add_fav.php",
                data:{data:id},
                success:function(event)
                {
                    console.log(event);
                    
            //adding fav to the database
            
            $("#"+This).removeClass("fav_show_hide_1");
            $("#"+This).addClass("fav_show_hide_0");
            let elem=$("#message"+id).clone();
            elem.removeAttr("id");
            elem.attr("id","favourite"+id);
            $("#menu1").append(elem);
                }
            });
        }
        else if($("#"+This).hasClass("fav_show_hide_0"))
        {
            $.ajax({
                type:"post",
                url:"../rem_fav.php",
                data:{data:id},
                success:function(event)
                {
                    console.log(event);
                    $("#"+This).removeClass("fav_show_hide_0");
            $("#"+This).addClass("fav_show_hide_1");
            $("#favourite"+id).remove();
                }
            });
            
        }
        //$("#"+This).removeClass("fav_show_hide_1");
        //$("#"+This).addClass("fav_show_hide_0");
        
            
        //ajax request for updating data
        
        //then adding fav_show_hide_0
    }
var del_id;
function deleting(id)
{
    del_id=id;
    console.log("delete id is set");
}
//annonymous message deleting function
function deleteConfirm()
    {
        console.log("deleting the element...");
         $.ajax({
            type:"post",
            url:"../del_msg.php",
            data:{data:del_id},
            success:function(event){
                $("#message"+del_id).remove();
                $("#favourite"+del_id).remove();
                console.log(event);
            }
        });
        return true;
    }

//function to validate login fields
function login_val()
{
    
    var username=$("#username").val();
    var pass=$("#pass").val();
    console.log(username);
    console.log(pass);
    if(username=="")
        {
            $("#user_err").text("Username must not be empty")
            return false;
        }
    
    if(pass=="")
        {
            $("#user_err").text("Password must not be empty")
            return false;
        }
    return true;
}

//function to validate username availability
function username_validate(username)
    {
        
    console.log(username);
    $("#username").css("border","1px solid black");
    var ck_username = /^[A-Za-z0-9_]{1,20}$/;
    if(ck_username.test(username))
        {
            if(username.length<3)
            {
                 $("#username").css("border","1px solid red");
                    $("#user_err").text("The username should be of at least three characters and should only contain letters and numbers");
                    $("input[type=submit]").attr('disabled','disabled');
            }
            else
            {
                 console.log("correct type");
            $.ajax({
        type:"post",
        data:{data:username},
        url:"http://localhost:8080/sec_message/php/account/check_username.php",
        success:function(event){
            console.log(event)
            if(event=="false")
                {
                    $("#username").css("border","1px solid red");
                    $("#user_err").text("Username not avialable");
                    $("input[type=submit]").attr('disabled','disabled');
                }
            else if(event=="true")
                {
                    $("#username").css("border","1px solid green");
                    $("#user_err").text("");
                    $("#user_err").css("color","red");
                    $("input[type=submit]").removeAttr('disabled');
                }
        }
    });
            }
           
        }
    else{
        console.log("incorrect data");
        $("#username").css("border","1px solid red");
        $("#user_err").text("please include on apphabets and numbers");
        $("input[type=submit]").attr('disabled','disabled');
    }    
    }
    
