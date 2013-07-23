<? $uri = $_SERVER['REQUEST_URI'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
  <HEAD>
    <TITLE>Tool Labs</TITLE>
    <LINK rel="StyleSheet" href="/style.css" type="text/css" media=screen>
    <META charset="utf-8">
    <META name="title" content="Tool Labs">
    <META name="description" content="This is the Tool Labs project for community-developed tools assisting the Wikimedia projects.">
    <META name="author" content="Wikimedia Foundation">
    <META name="copyright" content="Creative Commons Attribution-Share Alike 3.0">
    <META name="publisher" content="Wikimedia Foundation">
    <META name="language" content="Many">
    <META name="robots" content="index, follow">
  </HEAD>
  <BODY>
    <H1>Internal error</H1>
    The URI you have requested,
    <A href="http://tools.wmflabs.org<?= $uri ?>"><code>http://tools.wmflabs.org<?= $uri ?></code></A>,
    appears to be non-functional at this time.<p>
    <? $tool = '';
       if(preg_match("@^/([^/]+)/@", $uri, $part)) {
         $gr = posix_getgrnam("local-".$part[1]);
         if($gr) {
           $tool = $part[1];
           $maintainers = $gr['members'];
         }
       }
       if($tool != ''):
    ?>
      <H2>If you have reached this page from somewhere else...</H2>
      This URI is part of the <A href="/?tool=<?= $tool ?>"><code><?= $tool?></code></a> tool, maintained by 
      <? foreach($maintainers as $num => $maint):
           $mu = posix_getpwnam($maint);
           if($mu):
             $wtu = $mu['gecos'];
             ?><A HREF="https://wikitech.wikimedia.org/wiki/User:<?= $wtu ?>"><?= ucfirst($wtu) ?></A><?
           else:
             echo ucfirst($maint);
           endif;
           if($num < count($maintainers)-1) {
             if($num == count($maintainers)-2) {
               if($num == 0)
                 print " and ";
               else
                 print ", and ";
             } else
               print ", ";
           }
           endforeach;
      ?>.<p>
      Perhaps its magical script elves are temporarily ill, or the link you've followed doesn't actually lead
      somewhere useful?
      <p>
      If you're pretty sure this shouldn't be an error, you may wish to notify the tool's maintainers (above)
      about the error and how you ended up here.
      <H2>If you maintain this tool</H2>
      The error might be caused by incorrect permission, or by an error in the script or CGI that was meant
      to execute here.  You may wish to check your logs or 
      <A href="https://wikitech.wikimedia.org/wiki/Nova_Resource:Tools/Help#Logs">common causes for errors</A> in the help
      documentation.
    <? else: ?>
      Perhaps the webserver has temporarily lost its mind, or the link you've followed doesn't actually lead
      somewhere useful?
      <p>
      If you're pretty sure this shouldn't be an error, you may wish to notify the
      <A href="/?tool=admin">project administrators</A>
      about the error and how you ended up here.
    <? endif ?>
  </BODY>
</HTML>

