
    <script type="text/javascript">
    $(document).ready(function(){
        $("form#my_form").validate({
            rules: {
                emailo:{
                  
                	remote: {
                    	//url: 'email_checker.php',
                    	url: '/niuQuinbi/dominios/check',
                    	type: 'post',
                    	
                    	
                    }
                }
            },
            messages: {
                emailo: {
                    remote:jQuery.format("Email \"{0}\" have been used.")
                }
            }
        });
    });
    </script>

<form name="my_form" id="my_form" method="post" action="process.php">
    <h1>Check email availability</h1>
    <input type="text" name="emailo" id="email" />
    <input type="submit" value="Proses" />
</form>