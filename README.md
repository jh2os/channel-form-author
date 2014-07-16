Channel Form Author
===================

ExpressionEngine extension that allows you to change the author of newly submitted entries through channel forms


Installation
==================

 Move the "EE2 / third_party / channel_form_author" folder to your ExpressionEngine third party folder
 
 In your EE control pannel, go to extensions and install the Channel Form Author extension
 
 
How to Use
==================
 
 After installing the extension you can ad an input field with the name "cfaid" in your channel form and put the id of the author you wish to spoof as the value.
 
 e.g.
 
<input type="hidden" name="cfaid" value="1">

 This will cause the submitted entry to change authorship to the Member with the associated id.
