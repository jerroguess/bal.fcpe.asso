<?php if(!empty($message)) { ?>
<div class="success"><?php echo $message ?></div><?php } ?>

<h1>Installation - Stage 3</h1>

<p>Your configuration options have been successfully saved.</p>

<h2>Verify test page is working correctly</h2>

<p>This installation comes with a test page. You should now check the test page is working correctly.</p>

<p>Click this link <a href="test_page/compress_me.php" target="_blank">to view the test page</a>.</p>

<h2>What should you see on the test page?</h2>

<p>
<ul>
	<li>Under "<strong>Standard Horizontal Slide</strong>" you should be able to slide the red block. </li>
	<li>Under "<strong>Is the CSS still working?</strong>" each phrase should be a different colour, and have a different background (removed has a white background)</li>
	<li>View the source of the page and you should see the links to the compressed javascript and CSS</li>
	<li>Look in the cache directories what we have specified in the install. You should see the compressed JavaScript and CSS files there.</li>
</ul>
</p>

<h2>That's working. OK now what?</h2>

<p>Now should should add the PHP Speedy code to your own PHP page. This is made a lot easier if you have one PHP file that serves every page in your site. In a Wordpress 2.3 blog, for example, this would be the <strong>index.php</strong> file for your theme. Because <strong>index.php</strong> is accessed for every page, we just have to modify that file. If you have different PHP files serving different pages, then you will need to modify each of those pages.
</p>

<h3>How to modify your PHP file</h3>

<p>Let's say we are modifying the index.php of a Wordpress 2.3 blog. At the very top of the page you might see something like this at the very top of the page:
<p>
		<span class="red">&lt;?php</span><br />
		  get_header();<br />
		  <span class="red">?&gt;</span><br />
</p>
<p>We need to add in the PHP Speedy code <strong>before</strong> that. So you would add this to the very top of the page:
<p>
	  <span class="red">&lt;?php</span><br />
	  <span class="green">require</span>(<span class="red">'<?php echo($paths['full']['current_directory']) ?>php_speedy.php'</span>);<br />
	  <span class="red">?&gt;</span><br />
</p>
</p>
<p>Finally, we must then add one more line of code to the very bottom of the page as follows:
<p>
	  <span class="red">&lt;?php</span><br />
	  $compressor->finish();<br />
	  <span class="red">?&gt;</span><br />
</p>
<p>

<h2>Now for some testing...</h2>

<p>That's all you have to do. I recommend testing this out on a non-live site first, and then playing with the options to get optimal performance. To change the options you can:
<ul>
		<li>Manually edit the config.php file here: <?php echo($paths['full']['current_directory']) ?>config.php</li>
		<li>Just run this install again. It will remember your current options.</li>
</ul>
</p>
<h2>Extra security</h2>

<p>Although the package installs a username and password to access the install, you can also delete <?php echo($paths['full']['current_directory']) ?>install.php for extra security.
</p>