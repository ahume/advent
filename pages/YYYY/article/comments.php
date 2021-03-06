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
        </div>

        <section class="section" id="comments">
            <h1 class="section--title">11 Comments</h1>
            <p>Comments are ordered by helpfulness, as indicated by you. Help us pick out the gems and discourage asshattery by voting on notable comments.</p>
            <p>Got something to add? You can leave a comment below.</p>
            <ol class="list list-comments">
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
                <li>
<?                  inc('partial','summary-comment') ?>
                </li>
            </ol><!--/.list-comments-->
        </section>

        <form id="comment" method="post">
            <fieldset>
                <legend>Impress us</legend>
                <p>Be friendly / use <a href="http://www.textism.com/tools/textile/">Textile</a></p>
                <p>
                    <label for="commentName">Name</label>
                    <input id="commentName" name="commentName" type="text" required="required">
                </p>
                <p>
                    <label for="commentEmail">Email</label>
                    <input id="commentEmail" name="commentEmail" type="email" required="required">
                </p>
                <p>
                    <label for="commentURL">Website</label>
                    <input id="commentURL" name="commentURL" type="url" placeholder="http://">
                </p>
                <p>
                    <label for="commentHTML">Message</label>
                    <textarea id="commentHTML" name="commentHTML" cols="25" rows="5" required="required"></textarea>
                </p>
            </fieldset>
            <p>
                <input type="hidden" name="parentID" id="parentID" value="289"/>
                <input type="hidden" name="parentTitle" id="parentTitle" value="HTML5 Video Bumpers"/>
                <input type="submit" name="submitComment" id="submitComment" value="Submit">
            </p>
        </form>
    </main><!--/@main-->

<?  inc('partial','navigation') ?>
<?  inc('partial','contentinfo') ?>
</body>
</html>