
BaseURl:  http://emergingncr.com/mangalcity/
<hr>
<h2>User Login/Ragister </h2>
<h4>login</h4>
URL:http://emergingncr.com/mangalcity/api/auth/login
<p>parameter:
mobile,
password</p>

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
<p>parameter:
otp,mobile
</p>

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


<h4>update profile</h4>
	http://emergingncr.com/mangalcity/api/userprofile
<p>method:post</p>
<p>parameter:token,first_name,last_name,email,country,state,district,city</p>


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
<p>parameter:token</p>

