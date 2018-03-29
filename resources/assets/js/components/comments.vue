<template>
    <div class="comments" style="clear:both;margin-top:10px;">
        <div id="message"></div>
        <form method="post" name="formComment" id="formComment">
            <div class="comment-preview">
                <div class="form-group">
                    <label for="name">Name*:</label>
                    <input class="form-control" id="name" name="name" v-model="comments.name" />                    
                </div>
                <div class="form-group">
                    <label for="email">Email*:</label>
                    <input class="form-control" id="email" name="email" v-model="comments.email" />
                </div>
                <div class="form-group">
                    <label for="comment">Comment*:</label>
                    <textarea class="form-control" rows="5" id="comment" name="comment" v-model="comments.comment"></textarea>
                </div>            
                <input type="button" name="submit" class="btn btn-success pull-right" value="Add Comment" @click="newComment">            
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                comments: {
                    name: this.user.name,
                    email: this.user.email,
                    comment: '',
                    postid: this.postid,
                },
                errors: []
            }
        },
        props:[
            'postid', 'login', 'user_name', 'user'
        ],        
        methods : {
            newComment() {                
                var isValid = this.checkValidation();                
                if (isValid !== 0) {
                    return false;
                }
                //if (this.login) {
                    this.comments.postid = this.postid; 
                    //console.log('Comments : ', this.comments);                    
                    axios.post('/addComment', {
                        comment : this.comments.comment,
                        post_id : this.comments.postid,
                        name : this.comments.name,
                        email : this.comments.email,
                    }).then(response => {
                        if (typeof response.data.response_status !== 'undefined' && response.data.response_status === 'success') {
                           this.comments.comment = '';
                           $('#message').html('<div class="alert alert-success"><strong>Success!</strong> ' + response.data.message + '</div>');
                        } else {
                           $('#message').html('<div class="alert alert-danger"><strong>Danger!</strong> ' + response.data.message + '</div>'); 
                        }
                      }).catch(function (error) {
                        console.log(error);
                      });
                //} else {
                //    window.location.href = '/login';
                //}
            },
            checkValidation () {
                var errors = {};
                $('.errors').remove();
                $.each(this.comments, function (key, value) {                    
                    if (value == "") {                        
                        errors[key] = key.charAt(0).toUpperCase() + key.substr(1).toLowerCase() + ' field is required.';                        
                    }
                });                
                $.each(errors, function (key, value) {                    
                    $('#' + key).after('<div class="errors">' + value + '</div>');
                });
                
                return Object.keys(errors).length;
            }
        }
    }
</script>
