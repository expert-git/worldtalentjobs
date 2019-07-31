   <?php
 
  include 'header.php';

  
  
  ?>


<div class="container">



<div class="conhead">
<h1 class="contact">CONTACT US</h1></div>



	<div class="row">
		<form role="form" id="contact-form" class="contact-form">
		<div class="row">
                		<div class="col-md-6">
                  		<div class="form-group">
                            <input type="text" class="form-control" name="Name" autocomplete="off" id="Name" placeholder="Name">
                  		</div>
                  	</div>
                    	<div class="col-md-6">
                  		<div class="form-group">
                            <input type="email" class="form-control" name="email" autocomplete="off" id="email" placeholder="E-mail">
                  		</div>
                  	</div>
                  	</div>
		
		
                    <div class="row">
					<div class="col-md-6">
                  		<div class="form-group">
                            <input type="email" class="form-control" name="email" autocomplete="off" id="email" placeholder="E-mail">
                  		</div>
                  	</div>
                		<div class="col-md-6">
                  		<div class="form-group">
                            <select name="profession" class="c-form-profession form-control" id="c-form-profession">
        <option value="Your profession...">Job</option>
        <option value="Web design">Web design</option>
        <option value="SEO">SEO</option>
        <option value="Marketing">Marketing</option>
    </select>
                  		</div>
                  	</div>
                    	
                  	</div>
                  	<div class="row">
                  		<div class="col-md-12">
                  		<div class="form-group">
                            <textarea class="form-control textarea" rows="3" name="Message" id="Message" placeholder="Message"></textarea>
                  		</div>
                  	</div>
                    </div>
                    <div class="row">
					 <div class="col-md-6">
                  <button type="submit" class="btn uplaoad main-btn pull-left">UPLOAD NEW</button>
                  </div></div>
					<div class="row">
                    <div class="col-md-12">
                  <button type="submit" class="btn sendbut main-btn pull-right">Send </button>
                  </div>
                  </div>
                </form>
	</div>





</div>

 <?php
 
  include 'footer.php';

  
  
  ?>






</body>
<script>

$('#contact-form').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Name: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required and cannot be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    emailAddress: {
                        message: 'The email address is not valid'
                    }
                }
            },
            Message: {
                validators: {
                    notEmpty: {
                        message: 'The Message is required and cannot be empty'
                    }
                }
            }
        }
    });
</script>


</html>
