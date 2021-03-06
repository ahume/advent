<? include_once($_SERVER['DOCUMENT_ROOT'].'/_inc/functions.php'); ?>
<? lesscss('/_css/less/styles.less', '/_css/styles.css'); ?>
<? $title = "Starting Your HTML5 Project on the Right Foot (and Keeping It There)"; ?>
<? inc('partial','head') ?>
<? inc('partial','banner') ?>

    <main role="main">
        <div class="article">

            <header class="article--header">
                <h1 class="article--title p-name">Starting Your <abbr>HTML5</abbr> Project on the Right Foot (and Keeping It There)</h1>
                <a class="article--byline h-card p-author" href="http://allinthehead.com/">
                    <img class="p-photo" src="http://media.24ways.org/authors/drewmclellan280.jpg" width="160" height="160" alt="Drew McLellan"/>
                    by Drew McLellen
                </a>
            </header>

            <footer class="article--footer">
                <ul class="list">
                    <li><time class="dt-published" datetime="2012-12-01T00:00:00-00:00">1 December 2012</time></li>
                    <li>Published in <a href="/pages/topics/topic/">Code</a></li>
                    <li><a href="#comments">3 comments</a></li>
                </ul>
            </footer>

            <div class="article--content">
                <p class="lede">Video is a bigger part of the web experience than ever before. With native browser support for <abbr>HTML5</abbr> video elements freeing us from the tyranny of plugins, and the availability of faster internet connections to the workplace, home and mobile networks, it&#8217;s now pretty straightforward to publish video in a way that can be consumed in all sorts of ways on all sorts of different web devices.</p>
                <p>I recently worked on a project where the client had shot some dedicated video shorts to publish on their site. They also had some five-second motion graphics produced to top and tail the videos with context and branding. This pretty common requirement is a great idea on the web, where a user might land at your video having followed a link and be viewing a page without much context.</p>
                <p>Known as <em>bumpers</em>, these short introduction clips help brand a video and make it look a lot more professional.</p>
                <figure>
                    <img src="http://media.24ways.org/2012/mclellan/timeline.png" alt="Video timeline" />
                </figure>

                <h2>Adding bumpers to a video</h2>
                <p>The simplest way to add bumpers to a video would be to edit them on to the start and end of the video file itself. Cooking the bumpers into the video file is easy, but should you ever want to update them it can become a real headache. If the branding needs updating, for example, you&#8217;d need to re-edit and re-encode all your videos. Not a fun task.</p>
                <p>What if the bumpers could be added dynamically? That would enable you to use the same bumper for multiple videos (decreasing download time for users who might watch more than one) and to update the bumpers whenever you wanted. You could change them seasonally, update them for special promotions, run different advertising slots, perform multivariate testing, or even target different bumpers to different users.</p>
                <p>The trade-off, of course, is that if you dynamically add your bumpers, there&#8217;s a chance that a user in a given circumstance might not see the bumper. For example, if the main video feature was uploaded to YouTube, you&#8217;d have no way to control the playback. As always, you need to weigh up the pros and cons and make your choice.</p>

                <h2><abbr>HTML5</abbr> bumpers</h2>
                <p>If you wanted to dynamically add bumpers to your <abbr>HTML5</abbr> video, how would you go about it? That was the question I found myself needing to answer for this particular client project.</p>
                <p>My initial thought was to treat it just like an image slideshow. If I were building a slideshow that moved between images, I&#8217;d use <span class="caps">CSS</span> absolute positioning with <code>z-index</code> to stack the images up on top of each other in a pile, with the first image on top. To transition to the second image, I&#8217;d use JavaScript to fade the top image out, revealing the second image beneath it.</p>
                <figure>
                    <img src="http://media.24ways.org/2012/mclellan/stack.png" alt="Video layers stacked up" />
                </figure>
                <p>Now that video is just a native object in the <span class="caps">DOM</span>, just like an image, why not do the same? Stack the videos up with the opening bumper on top, listen for the video&#8217;s <code>onended</code> event, and fade it out to reveal the main feature behind. Good idea, right?</p>

                <h2>Wrong</h2>
                <p>Remember that this is the web. It&#8217;s never going to be that easy. The problem here is that many non-desktop devices use native, dedicated video players. Think about watching a video on a mobile phone &#8211; when you play the video, the phone often goes full-screen in its native player, leaving the web page behind. There&#8217;s no opportunity to fade or switch <code>z-index</code>, as the video isn&#8217;t being viewed in the page. Your page is left powerless. Powerless!</p>
                <figure>
                    <img src="http://media.24ways.org/2012/mclellan/media-player.jpg" alt="iOS full-screen media player" />
                </figure>
                <p>So what can we do? What can we control?</p>
                <p>Those of us with particularly long memories might recall a time before <span class="caps">CSS</span>, when we&#8217;d have to use JavaScript to perform image rollovers. As <span class="caps">CSS</span> background images weren&#8217;t a practical reality, we would use lots of <code>&lt;img&gt;</code> elements, and perform a rollover by modifying the <code>src</code> attribute of the image. </p>
                <p>Turns out, this old trick of modifying the source can help us out with video, too. In most cases, modifying the <code>src</code> attribute of a <code>&lt;video&gt;</code> element, or perhaps more likely the <code>src</code> attribute of a <code>source</code> element, will swap from one video to another.</p>

                <h2>Swappin&#8217; it</h2>
                <p>Let&#8217;s take a deliberately simple example of a super-basic video tag:</p>
<pre><code class="language-markup">&lt;video src=&quot;mycat.webm&quot; controls&gt;no fallback coz i is lame, innit.&lt;/video&gt;</code></pre>
                <p>We could very simply write a script to find all video tags and give them a new <code>src</code> to show our bumper.</p>
<pre><code class="language-javascript">&lt;script&gt;
    var videos, i, l;
    videos = document.getElementsByTagName(&#39;video&#39;);
    for(i=0, l=videos.length; i&lt;l; i++) {
        videos[i].setAttribute(&#39;src&#39;, &#39;bumper-in.webm&#39;);
    }
&lt;/script&gt;
</code></pre>
                <p><a href="http://media.24ways.org/2012/mclellan/examples/1.html">View the example</a> in a browser with WebM support. You&#8217;ll see that the video is swapped out for the opening bumper. Great!</p>

                <h2>Beefing it up</h2>
                <p>Of course, we can&#8217;t just publish video in one format. In practical use, you need a <code>&lt;video&gt;</code> element with multiple <code>&lt;source&gt;</code> elements containing your different source formats.</p>
<pre><code class="language-markup">&lt;video controls&gt;
    &lt;source src=&quot;mycat.mp4&quot; type=&quot;video/mp4&quot; /&gt;
    &lt;source src=&quot;mycat.webm&quot; type=&quot;video/webm&quot; /&gt;
    &lt;source src=&quot;mycat.ogv&quot; type=&quot;video/ogg&quot; /&gt;
&lt;/video&gt;
</code></pre>
                <p>This time, our script needs to loop through the sources, not the videos. We&#8217;ll use a regular expression replacement to swap out the file name while maintaining the correct file extension.</p>
<pre><code class="language-javascript">&lt;script&gt;
    var sources, i, l, orig;
    sources = document.getElementsByTagName(&#39;source&#39;);
    for(i=0, l=sources.length; i&lt;l; i++) {
        orig = sources[i].getAttribute(&#39;src&#39;);
        sources[i].setAttribute(&#39;src&#39;, orig.replace(/(w+).(w+)/, &#39;bumper-in.$2&#39;));
        // reload the video
        sources[i].parentNode.load();
    }
&lt;/script&gt;
</code></pre>
                <p>The difference this time is that when changing the <code>src</code> of a <code>&lt;source&gt;</code> we need to call the <code>.load()</code> method on the video to get it to acknowledge the change.</p>
                <p><a href="http://media.24ways.org/2012/mclellan/examples/2.html">See the code in action</a>, this time in a wider range of browsers.</p>

                <h2>But, my video!</h2>
                <p>I guess we should get the original video playing again. Keeping the same markup, we need to modify the script to do two things:</p>
                <ol>
                    <li>Store the original <code>src</code> in a <code>data-</code> attribute so we can access it later</li>
                    <li>Add an event listener so we can detect the end of the bumper playing, and load the original video back in</li>
                </ol>
                <p>As we need to loop through the videos this time to add the event listener, I&#8217;ve moved the <code>.load()</code> call into that loop. It&#8217;s a bit more efficient to call it only once after modifying all the video&#8217;s sources.</p>
<pre><code class="language-javascript">&lt;script&gt;
    var videos, sources, i, l, orig;
    sources = document.getElementsByTagName(&#39;source&#39;);
    for(i=0, l=sources.length; i&lt;l; i++) {
        orig = sources[i].getAttribute(&#39;src&#39;);
        sources[i].setAttribute(&#39;data-orig&#39;, orig);
        sources[i].setAttribute(&#39;src&#39;, orig.replace(/(w+).(w+)/, &#39;bumper-in.$2&#39;));
    }
    videos = document.getElementsByTagName(&#39;video&#39;);
    for(i=0, l=videos.length; i&lt;l; i++) {
        videos[i].load();
        videos[i].addEventListener(&#39;ended&#39;, function(){
            sources = this.getElementsByTagName(&#39;source&#39;);
            for(i=0, l=sources.length; i&lt;l; i++) {
                orig = sources[i].getAttribute(&#39;data-orig&#39;);
                if (orig) {
                    sources[i].setAttribute(&#39;src&#39;, orig);
                }
                sources[i].setAttribute(&#39;data-orig&#39;,&#39;&#39;);
            }
            this.load();
            this.play();
        });
    }
&lt;/script&gt;
</code></pre>
                <p>Again, <a href="http://media.24ways.org/2012/mclellan/examples/3.html">view the example</a> to see the bumper play, followed by our spectacular main feature. (That&#8217;s my cat, Widget. His interests include sleeping and internet marketing.)</p>

                <h2>Tidying things up</h2>
                <p>The final thing to do is add our closing bumper after the main video has played. This involves the following changes:</p>
                <ol>
                    <li>We need to keep track of whether the <code>src</code> has been changed, so we only play the video if it&#8217;s changed. I&#8217;ve added the <code>modified</code> variable to track this, and it stops us getting into a situation where the video just loops forever.</li>
                    <li>Add an <code>else</code> to the event listener, for when the <code>orig</code> is false (so the main feature has been playing) to load in the end bumper. We also check that we&#8217;re not already playing the end bumper. Because looping.</li>
                </ol>
<pre><code class="language-javascript">&lt;script&gt;
    var videos, sources, i, l, orig, current, modified;
    sources = document.getElementsByTagName(&#39;source&#39;);
    for(i=0, l=sources.length; i&lt;l; i++) {
        orig = sources[i].getAttribute(&#39;src&#39;);
        sources[i].setAttribute(&#39;data-orig&#39;, orig);
        sources[i].setAttribute(&#39;src&#39;, orig.replace(/(w+).(w+)/, &#39;bumper-in.$2&#39;));
    }
    videos = document.getElementsByTagName(&#39;video&#39;);
    for(i=0, l=videos.length; i&lt;l; i++) {
        videos[i].load();
        modified = false;
        videos[i].addEventListener(&#39;ended&#39;, function(){
            sources = this.getElementsByTagName(&#39;source&#39;);
            for(i=0, l=sources.length; i&lt;l; i++) {
                orig = sources[i].getAttribute(&#39;data-orig&#39;);
                if (orig) {
                    sources[i].setAttribute(&#39;src&#39;, orig);
                    modified = true;
                } else {
                    current = sources[i].getAttribute(&#39;src&#39;);
                    if (current.indexOf(&#39;bumper-out&#39;)==-1) {
                        sources[i].setAttribute(&#39;src&#39;, current.replace(/([w]+).(w+)/, &#39;bumper-out.$2&#39;));
                        modified = true;
                    } else {
                        this.pause();
                        modified = false;
                    }
                }
                sources[i].setAttribute(&#39;data-orig&#39;,&#39;&#39;);
            }
            if (modified) {
                this.load();
                this.play();
            }
        });
    }
&lt;/script&gt;
</code></pre>
                <p>Yo ho ho, that&#8217;s a lot of JavaScript. <a href="http://media.24ways.org/2012/mclellan/examples/4.html">See it in action</a> &#8211; you should get a bumper, the cat video, and an end bumper.</p>
                <p>Of course, this code works fine for demonstrating the principle, but it&#8217;s very procedural. Nothing wrong with that, but to do something similar in production, you&#8217;d probably want to make the code more modular to ease maintainability. Besides, you may want to use a framework, rather than basic JavaScript. </p>

                <h2>The end credits</h2>
                <p>One really important principle here is that of <strong>progressive enhancement</strong>. If the browser doesn&#8217;t support JavaScript, the user won&#8217;t see your bumper, but they will get the main video. If the browser supports JavaScript but doesn&#8217;t allow you to modify the <code>src</code> (as was the case with older versions of iOS), the user won&#8217;t see your bumper, but they will get the main video.</p>
                <p>If a search engine or social media bot grabs your page and looks for content, they won&#8217;t see your bumper, but they will get the main video &#8211; which is absolutely what you want.</p>
                <p>This means that if the bumper is absolutely crucial, you may still need to cook it into the video. However, for many applications, running it dynamically can work quite well.</p>
                <p>As always, it comes down to three things:</p>
                <ol>
                    <li>Measure your audience: know how people access your site</li>
                    <li>Test the solution: make sure it works for your audience</li>
                    <li>Plan for failure: it&#8217;s the web and that&#8217;s how things work &#8216;round these parts</li>
                </ol>
                <p>But most of all <strong>play around with it, have fun and build something awesome</strong>.</p>
            </div>
        </div><!--/.article-->

        <section id="author">
            <h1>About the author</h1>
            <p><strong>Drew McLellan</strong> is lead developer on your favourite small <span class="caps">CMS</span>, <a href="http://grabaperch.com/">Perch</a>. He is Director and Senior Developer at UK-based web development agency edgeofmyseat.com, and formerly Group Lead at the Web Standards Project. When not publishing 24 ways, Drew keeps a <a href="http://allinthehead.com/">personal site</a> covering web development issues and themes, <a href="http://flickr.com/drewm/">takes photos</a> and <a href="http://twitter.com/drewm">tweets a lot</a>.</p>
        </section>

        <section id="comments">
            <h1>Comments</h1>
            <a href="comments.php">View 11 reader comments</a>
        </section>

        <section id="related">
            <h1>Related articles</h1>
            <ul class="list list-articles">
                <li>
<?                  inc('partial','summary-article') ?>
                </li>
                <li>
<?                  inc('partial','summary-article') ?>
                </li>
                <li>
<?                  inc('partial','summary-article') ?>
                </li>
            </ul><!--/.list-articles-->
        </section>
    </main><!--/@main-->

<?  inc('partial','navigation') ?>
<?  inc('partial','contentinfo') ?>
<?  inc('partial','foot') ?>