<%EnableSessionState=False
host = Request.ServerVariables("HTTP_HOST")

if host = "forteroche.sanb.fr" or host = "www.forteroche.sanb.fr" then response.redirect("https://www.forteroche.sanb.fr/index.php")

else
response.redirect("https://www.forteroche.sanb.fr/index.php")
end if
%>
