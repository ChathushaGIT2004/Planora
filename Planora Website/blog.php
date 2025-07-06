<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Planning Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #555879;
            --secondary-color: #98A1BC;
            --accent-color: #DED3C4;
            --background: #F4EBD3;

            --text-color: #555879;
            --text-light: #98A1BC;
            --text-white: #ffffff;
            --white: #ffffff;
            --gray-light: #F4EBD3;
            --gray-dark: #333333;

            --gradient-1: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-2: linear-gradient(135deg, var(--accent-color) 0%, var(--secondary-color) 100%);
            --gradient-dark: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7));
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/backblog.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(255,255,255,0.5); 
            z-index: -1;
        }
        .blog-container { max-width: 900px; margin: 2rem auto; background: #fff; border-radius: 16px; box-shadow: 0 2px 16px rgba(85,88,121,0.07); padding: 2rem; }
        .blog-post { margin-bottom: 2.5rem; border-bottom: 1px solid #eee; padding-bottom: 2rem; }
        .blog-post:last-child { border-bottom: none; }
        .blog-title { font-size: 2rem; color: #555879; margin-bottom: 0.5rem; }
        .blog-meta { color: #aaa; font-size: 0.95rem; margin-bottom: 1rem; }
        .blog-img { width: 100%; max-height: 350px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem; }
        .blog-content { color: #222; font-size: 1.13rem; margin-bottom: 1rem; }
        .blog-video { width: 100%; max-width: 600px; margin: 1rem 0; }

        
        .blog-header {
            background: transparent;
            padding: 1.5rem 0 1rem 0;
            text-align: left; /* Change from center to left */
            box-shadow: 0 2px 8px rgba(85,88,121,0.04);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .blog-logo {
            width: 300px;
            height: 300px;
            object-fit: contain;
            border-radius: 50%;
            margin-bottom: 0;
            margin-left: 20rem;
        }
        .blog-heading {
            font-size: 2.3rem;
            color: #555879;
            font-weight: 700;
            margin: 0.1rem 10rem 10rem 0;
            letter-spacing: 1px;
            margin-bottom: 0;
        }
        
        .blog-container { 
            max-width: 900px; 
             
            background: #fff; 
            border-radius: 16px; 
            box-shadow: 0 2px 16px rgba(85,88,121,0.07); 
            padding: 2rem;
            margin-bottom: 1rem; 
        }
        .blog-post { 
            margin-bottom: 2.5rem; 
            border-bottom: 1px solid #eee; 
            padding-bottom: 2rem; 
            margin-bottom: 2.5rem;
            margin-top: 1.5rem;
        }
        .blog-post:last-child { border-bottom: none; }
        .blog-title { font-size: 2rem; color: #555879; margin-bottom: 0.5rem; }
        .blog-meta { color: #aaa; font-size: 0.95rem; margin-bottom: 1rem; }
        .blog-img { width: 100%; max-height: 350px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem; }
        .blog-content { color: #222; font-size: 1.13rem; margin-bottom: 1rem; }
        .read-more-link {
            color: #555879;
            font-weight: 600;
            text-decoration: underline;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        .blog-video {
            width: 100%;
            max-width: 600px;
            margin: 1rem auto 1.5rem auto;
            display: flex;
            justify-content: center;
        }
        @media (max-width: 700px) {
            .blog-container { padding: 1rem; }
            .blog-title { font-size: 1.3rem; }
            .blog-heading { font-size: 1.5rem; }
        }
        .blog-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0; width: 100vw; height: 100vh;
            background: rgba(24,24,24,0.85);
            align-items: center;
            justify-content: center;
        }
        .blog-modal-content {
            background: #fff;
            border-radius: 16px;
            max-width: 700px;
            width: 95vw;
            margin: auto;
            padding: 2rem;
            position: relative;
            box-shadow: 0 2px 32px rgba(85,88,121,0.13);
            animation: fadeIn 0.2s;
            max-height: 90vh;           /* Limit modal height */
            overflow-y: auto;           /* Enable vertical scroll if needed */
        }
        .blog-modal-close {
            position: absolute;
            top: 18px; right: 28px;
            font-size: 2rem;
            color: #555879;
            cursor: pointer;
            font-weight: 700;
            transition: color 0.2s;
        }
        .blog-modal-close:hover { color: #d32f2f; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>
    <div class="blog-header">
    <img src="images/Logo_without_bg.png" alt="Planora Logo" class="blog-logo">
    <div>
        <div class="blog-heading">Planora Wedding Planning Blog</div>
        <div style="color:var(--primary-color);font-size:1.1rem; margin-left: 5rem; margin-top: 1rem;">Tips, Inspiration &amp; Ideas for Your Dream Wedding</div>
    </div>
</div>
    
    <div class="blog-container">
        <h1>Wedding Planning Blog</h1>

        <div class="blog-post1">
    <div class="blog-title">11 Essential Wedding Planning Tips</div>
    <div class="blog-meta">July 2025 | By Planora Team</div>
    <img src="images/holding_hands.jpg" class="blog-img" alt="Wedding Tips">
    <div class="blog-content">
        Planning a wedding can be overwhelming. Here are 11 essential tips to help you stay organized and stress-free...
    </div>
    <a href="modal1" class="read-more-link" data-modal="modal1" style="color:#555879;font-weight:600;text-decoration:underline;cursor:pointer;">Read More</a>
</div>

<!-- Modal for first post -->
<div id="modal1" class="blog-modal">
    <div class="blog-modal-content">
        <span class="blog-modal-close" data-modal="modal1">&times;</span>
        <div class="blog-title">11 Essential Wedding Planning Tips</div>
        <div class="blog-meta">July 2025 | By Planora Team</div>
        <img src="images/couple.jpg" class="blog-img" alt="Wedding Tips">
        <div class="blog-content">
            
            <ol>
                <li>Start with a Clear Budget</li>
                <p>Before booking anything, sit down with your partner and agree on a realistic budget. Knowing your limits will help you prioritize spending.</p>
                <li>Create a Wedding Planning Timeline</li>
                <p>Outline all the tasks you need to complete and set deadlines for each. This will help you stay on track and avoid last-minute stress.</p>
                <li>Choose the Right Venue Early</li>
                <p>Research and visit potential venues well in advance. Popular locations can book up quickly, so secure your spot as soon as possible. Consider season, guest count, and your wedding theme when choosing the venue.</p>
                <li>Stick to a Consistent Theme</li>
                <p>Decide on a theme or color scheme that reflects your personality as a couple. This will guide your choices for decor, attire, and invitations. Whether it's rustic, beachy, or glam — consistency across décor, invites, and attire brings everything together beautifully.</p>
                <li>Don’t Overdo the Color Palette</li>
                <p>Choose a color palette that complements your theme and stick to it. Too many clashing colors can be overwhelming and take away from the overall aesthetic.</p>
                <li>Do a Hair & Makeup Trial</li>
                <p>Schedule a trial run for your hair and makeup to ensure you’re happy with the look. This will also help you feel more relaxed on the big day.</p>
                <li>Break in Your Wedding Shoes</li>
                <p>Wear your wedding shoes around the house to break them in. This will help prevent blisters and discomfort on your big day.</p>
                <li>Eat and Stay Hydrated</li>
                <p>Don’t skip meals while planning. Eating well and staying hydrated will keep your energy up and help you think clearly.</p>
                <li>Make a “Must-Have Shot” List</li>
                <p>List all the photos you absolutely want on your big day. Share this with your photographer to ensure they capture every moment.</p>
                <li>Let Go of Perfection</li>
                <p>Remember that not everything will go according to plan, and that's okay! Focus on the love and joy of the day rather than striving for perfection.</p>
                <li>Take a Moment for Just the Two of You</li>
                <p>Amidst the chaos of the day, find a quiet moment to connect with your partner. Whether it's a private toast or a quiet walk, these moments will help you cherish the day even more.</p>
            </ol>
            <p>With these tips, your wedding planning journey will be much smoother!</p>
        </div>
    </div>
</div>

        <div class="blog-post2">
            <div class="blog-title">How to Choose the Perfect Venue</div>
            <div class="blog-meta">June 2025 | By Planora Team</div>
            <div class="blog-content">
                The venue sets the tone for your big day. Consider your guest list, budget, and style before making a decision...
            </div>
            <div class="blog-video">
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/9OaLxOwv9xA?si=2SXhSI7jEjHuiWH1" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="blog-post3">
            <div class="blog-title">Creative Wedding Decor Ideas</div>
            <div class="blog-meta">May 2025 | By Planora Team</div>
            <img src="images/venue" class="blog-img" alt="Wedding Decor">
            <div class="blog-content">
                Want a wedding that your guests absolutely can't stop talking about? Epic wedding reception decorations are key. 
                You've gathered your closest loved ones together for a festive party and your venue deserves to be as well-dressed 
                as your guests.

                To get your creative juices flowing, we've gathered the very best wedding decoration ideas that'll inspire you.
                 From dramatic tabletop decorations to statement installations and floral arrangements that'll have everyone swooning, 
                 you're sure to find a wedding reception decor idea here that piques your interest. 
            </div>
            <a href="modal2" class="read-more-link" data-modal="modal2" style="color:#555879;font-weight:600;text-decoration:underline;cursor:pointer;">Read More</a>
        </div>

        <div id="modal2" class="blog-modal">
    <div class="blog-modal-content">
        <span class="blog-modal-close" data-modal="modal2">&times;</span>
        <div class="blog-title">Creative Wedding Decor Ideas</div>
        <div class="blog-meta">July 2025 | By Planora Team</div>
        <div class="blog-content">
            
            <ol>
                <li>Minimal Black and White Wedding Reception Decor Idea</li>
                <p>What's more simple and classic than black and white? Minimalist black chairs complemented this tablescape's white linen and the result was breathtaking.</p>
                <img src="images/black&white.jpg" class="blog-img" alt="Deco">
                <li>Simple Wedding Reception Decorations With Green Linens</li>
                <p>Opting for just a few long tables, instead of lots of smaller round tables, is a great way to simplify your wedding reception floor plan. This couple seated all their guests at three parallel tables with green linens and the result was beautiful.</p>
                <img src="images/green.jpg" class="blog-img" alt="Deco">
                <li>Simple Marquee Letter Decoration Idea</li>
                <p>How fun are these clean and simple oversized marquee letters? To embrace their Hawaiian venue, this couple rented light-up letters spelling out Ohana.</p>
                <img src="images/marqua.jpg" class="blog-img" alt="Deco">
                <li>Tropical Wedding Reception With Simple Woven Lanterns</li>
                <p>A selection of white and woven lanterns hung about the farm tables at this waterfront wedding. While the overall design was simple and didn't involve too many elements, the effect was stunning.</p>
                <img src="images/lantern.jpg" class="blog-img" alt="Deco">
                <li>Pink Draping Wedding Reception Decoration</li>
                <p>Is this not the most swoon-worthy setup you've ever seen? Pink drapes added a cozy feel to this outdoor wedding reception while gold chairs further reinforced the elevated aesthetic of the event.</p>
                <img src="images/pink.jpg" class="blog-img" alt="Deco">
                <li>Rustic Wedding Reception Decoration Ideas</li>
                <p>Rustic doesn't have to mean everything is brown and masculine. Quite the opposite—this couple brought in elegant feminine touches of pastel pink to their rustic wedding reception decor to give it an updated feel.</p>
                <img src="images/rustic.jpg" class="blog-img" alt="Deco">
            </ol>
        </div>
    </div>
</div>


        

    </div>
    <script>
document.querySelectorAll('.read-more-link').forEach(link => {
    link.onclick = function(e) {
        e.preventDefault();
        document.getElementById(this.dataset.modal).style.display = 'flex';
    };
});
document.querySelectorAll('.blog-modal-close').forEach(btn => {
    btn.onclick = function() {
        document.getElementById(this.dataset.modal).style.display = 'none';
    };
});
// Close modal when clicking outside content
document.querySelectorAll('.blog-modal').forEach(modal => {
    modal.onclick = function(e) {
        if (e.target === modal) modal.style.display = 'none';
    };
});
</script>
</body>
</html>