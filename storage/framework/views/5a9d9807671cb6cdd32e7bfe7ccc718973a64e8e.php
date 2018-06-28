
BaseURl:  http://emergingncr.com/mangalcity/
<hr>
<h2>User Login/Ragister </h2>
<h4>login</h4>
URL:http://emergingncr.com/mangalcity/api/auth/login
<p>parameter:
mobile,
password</p>

<hr>
<h2>Social login </h2>
<h4>login</h4>
URL:http://emergingncr.com/mangalcity/api/auth/social_login
<p>parameter:first_name,last_name,email,provider,provider_id</p>
<p>Responce:{"success":true,"data":{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjU2LCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgxL21hbmdhbGNpdHkvYXBpL2F1dGgvc29jaWFsX2xvZ2luIiwiaWF0IjoxNTMwMTk0MTE4LCJleHAiOjE1MzE0MDM3MTgsIm5iZiI6MTUzMDE5NDExOCwianRpIjoidDdUY1lnWFVtTEFaT1FKYiJ9.GdAmYprNtc97LF985BYecewrlOLG1iy-HQlagvAcDfw","user":{"id":56,"first_name":"kundan","last_name":"kumar","mobile":"12345678912345","email":"kundan@gmail.com","image":"default.png","cover_image":"default.png","country":"","state":"","district":"","city":"","address":"","gender":"male","marital_status":"no","verified":0,"profile":0,"status":"active","created_at":"2018-06-28 13:48:34","updated_at":"2018-06-28 13:48:34"}}}</p>
<hr>




<h4>Register</h4>
URL:http://emergingncr.com/mangalcity/api/auth/register
<p>parameter:
first_name,
last_name,
mobile,
email,
password,
password_confirmation</p>

<hr>
<h4>verify User</h4>
URL:http://emergingncr.com/mangalcity/api/auth/verifyUser
<p>parameter:otp,mobile</p>


<hr>
<h4>Resend otp</h4>
URL:http://emergingncr.com/mangalcity/api/auth/resend_otp
<p>parameter:mobile</p>
<p>method:POST</p>


<hr>
<h4>forgot password otp</h4>
URL:http://emergingncr.com/mangalcity/api/forgot_password_otp
<p>Method:POST</p>
<p>parameter:mobile</p>
<p>Responce:{ "success": true, "message": "successfully send otp" }</p>

<hr>
<h4>forgot change password</h4>
URL:http://emergingncr.com/mangalcity/api/forgot_change_password
<p>Method:POST</p>
<p>parameter:otp,mobile,password,confirmed_password</p>
<p>Responce:{"success":true,"message":"successfully update password,please login"}</p>

<hr>
<h4>Change password</h4>
	URL:http://emergingncr.com/mangalcity/api/change_password
<p>parameter:token,old_password,password,password_confirmation</p>
<p>method:post</p>

<hr>
<h4>Get User</h4>
URL:http://emergingncr.com/mangalcity/api/getuser
<p>parameter:token</p>
<p>method:post</p>


<hr>
<h4>Logout</h4>
URL:http://emergingncr.com/mangalcity/api/auth/logout
<p>parameter:
token
</p>

<hr>
<h2>Profile </h2>

<hr>
<h4>update profile</h4>
URL:http://emergingncr.com/mangalcity/api/userprofile
<p>method:post</p>
<p>parameter:token,first_name,last_name,email,country,state,district,city,image,cover_image,gender,marital_status,current_location,home_city,home_country,home_district,home_state
</p>

<hr>
<h4>update profile</h4>
URL:http://emergingncr.com/mangalcity/api/getprofile
<p>parameter:token </p>
<p>method:post</p>

<hr>
<h4>upload profile image</h4>
URL:http://emergingncr.com/mangalcity/api/change_profile_image
<p>parameter:token,image </p>
<p>method:post</p>

<hr>
<h4>update cover image</h4>
URL:http://emergingncr.com/mangalcity/api/change_cover_image
<p>parameter:token,cover_image </p>
<p>method:post</p>


<h4>State</h4>
	http://emergingncr.com/mangalcity/api/getstate
<p>parameter:
token
</p>

<hr>
<h4>Get distict</h4>
URL:http://emergingncr.com/mangalcity/api/getdistict
<p>parameter:
token,id
</p>

<hr>
<h4>get city</h4>
URL:http://emergingncr.com/mangalcity/api/getcity
<p>parameter:
token,id
</p>




<hr>
<h2>Post </h2>
http://emergingncr.com/mangalcity/api/post
<p>method:post </p>
<p>parameter:
token,message,video,image
</p>
<p>Responce:{"success":true,"pdata":{"id":37,"user_id":55,"message":"api post","type":"","value":"","likes":"0","dislikes":"0","tag":1,"created_at":{"date":"2018-06-09 06:02:28.000000","timezone_type":3,"timezone":"UTC"},"name":"pooja kumari","image":"http:\/\/localhost:81\/mangalcity\/public\/images\/user\/default.png"}}</p>


<hr>
<h2>feeds</h2>
http://emergingncr.com/mangalcity/api/feeds
<p>method:post </p>
<p>parameter:token,home_location=1,page=2</p>



<hr>
<h2>like</h2>
http://emergingncr.com/mangalcity/api/dolike
<p>method:post </p>
<p>parameter:token,post_id</p>
<p>Responce:{"success":true,"lcount":1,"dcount":0,"type":1}</p>
<p>press again:{"success":true,"lcount":0,"dcount":0,"type":0}</p>

<hr>
<h2>dislike</h2>
http://emergingncr.com/mangalcity/api/dodislikes
<p>method:post </p>
<p>parameter:token,post_id</p>
<p>Responce:{"success":true,"lcount":0,"dcount":1,"type":1}</p>

<hr>
<h2>share post</h2>
http://emergingncr.com/mangalcity/api/share_post
<p>method:post </p>
<p>parameter:token,post_id</p>

<hr>
<h2>Delete Post</h2>
http://emergingncr.com/mangalcity/api/delete_post
<p>method:post </p>
<p>parameter:token,post_id</p>

<hr>
<h2>spam tags</h2>
	http://emergingncr.com/mangalcity/api/spam_tags
<p>method:post </p>
<p>parameter:token</p>



<hr>
<h2>download image</h2>
	http://emergingncr.com/mangalcity/api/download_image/Image.png
<p>method:Get </p>
<p>parameter:token</p>

<hr>
<h2>Report Feedback</h2>
	http://emergingncr.com/mangalcity/api/report_feedback
<p>Method:POST </p>
<p>parameter:token,post_id,spam_tags</p>
