<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BEST Courses</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Press+Start+2P&display=swap" rel="stylesheet">
<style>
  [hidden] { display: none !important; }
  * { box-sizing: border-box; }
  html { scroll-behavior: smooth; }
  html, body { margin: 0; min-height: 100%; background: #0b0b17; color: #fff; font-family: 'Press Start 2P', monospace; }
  body.game { height: 100%; overflow: hidden; }
  body.classic { overflow: auto; }
  img {
    display: block;
}
  /* ================= INTRO ================= */
  #intro { position: fixed; inset: 0; display: grid; place-items: center; background: #0b0b17; z-index: 10; }
  .scene { position: relative; width: min(100vw, 200vh); }
  .scene img { width: 100%; }
  #bubble, #hint {
    background: #f4f1de; color: #14142b; border: 4px solid #14142b; box-shadow: 4px 4px 0 #14142b;
    text-align: center; line-height: 1.6;
  }
 
#bubble {
    position: absolute;
    left: 15%;
    top: 4%;
    transform: translateX(-50%);
    width: 20%;
    min-height: 15%;
    height: auto;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 2%;
    font-size: clamp(8px, 1.5vw, 16px);
    line-height: 1.6;
    overflow-wrap: break-word;
    text-align: center;
}

  .actions { position: absolute; left: 50%; bottom: 5%; transform: translateX(-50%);
             display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; width: 90%; }
  .pbtn { font-family: 'Press Start 2P', monospace; font-size: clamp(8px, 1.4vw, 14px); cursor: pointer;
          background: #ff6a04; color: #14142b; border: 4px solid #14142b; box-shadow: 4px 4px 0 #14142b; padding: 12px 16px; }
  .pbtn.alt { background: #f4f1de; }
  .pbtn:active { transform: translate(3px, 3px); box-shadow: 1px 1px 0 #14142b; }

  .stack { display: none; }
  .panel { display: block; }

  /* Portrait phones / tablets: stack the two halves of the scene vertically */
  @media (max-aspect-ratio: 3/4) {
    .scene {
      --s: min(calc(100vw - 32px), calc((100vh - 210px) / 2));
      --s: min(calc(100vw - 32px), calc((100dvh - 210px) / 2));
      width: var(--s);
      display: flex; flex-direction: column; align-items: center; gap: 0;
    }
    .scene .scene-wide { display: none; }
    .stack {
      order: 1; display: block; width: var(--s);
      background: #0b0b17; border: 4px solid #14142b; box-shadow: 4px 4px 0 #14142b;
    }
    .panel {
      width: 100%; aspect-ratio: 1;
      background: url('/images/intro-scene.svg') 0 0 / 200% 100% no-repeat;
      image-rendering: pixelated;
    }
    .panel-glass { background-position: 100% 0; }
    .scene #bubble {
      order: 0; margin-bottom: 22px;
      position: relative; left: auto; top: auto; transform: none;
      width: 100%; min-height: 64px; padding: 12px 14px;
      font-size: clamp(11px, 2.8vw, 16px); line-height: 1.6;
    }
    .scene #bubble::after {
      content: ''; position: absolute; left: 28%; bottom: -14px;
      border: 10px solid transparent; border-top-color: #14142b; border-bottom: 0;
    }
    .scene .actions { order: 2; position: static; transform: none; width: 100%; margin-top: 20px; }
    .scene .pbtn { font-size: clamp(10px, 2.8vw, 14px); padding: 12px 14px; }
  }

  /* ================= GAME (map) ================= */
  #sea { position: fixed; inset: 0; background: #1b6ca8 url('/images/sea.svg') 0 0 / 128px 128px;
         image-rendering: pixelated; touch-action: none; cursor: none; }
  .island { position: absolute; transform: translate(-50%, -50%); background: none; border: 0; padding: 0;
            cursor: pointer; color: #fff; font: inherit; font-size: 10px; text-shadow: 2px 2px 0 #14142b; text-align: center; }
  .island img { width: clamp(64px, 10vw, 110px); margin: 0 auto 6px; }
  #lens { position: fixed; width: clamp(240px, 38vmin, 420px); aspect-ratio: 1; transform: translate(-50%, -50%);
          pointer-events: none; z-index: 5; }
  #lens::before { content: ''; position: absolute; inset: 8.6%; border-radius: 50%; box-shadow: 0 0 0 200vmax rgba(5, 5, 15, .94); }
  #lens img { position: absolute; inset: 0; width: 100%; height: 100%; }
  #hint { position: fixed; top: 16px; left: 50%; transform: translateX(-50%); z-index: 6; width: auto; max-width: 90vw;
        padding: 10px 16px; font-size: clamp(9px, 1.4vw, 14px); line-height: 1.5; pointer-events: none; }
  #to-classic { position: fixed; right: 14px; bottom: 14px; z-index: 6; cursor: pointer; }

  
#card {
    position: fixed;
    left: 50%;
    bottom: 20px;
    transform: translateX(-50%);
    z-index: 20;
    width: min(92vw, 420px);
    background: #f4f1de;
    color: #14142b;
    border: 4px solid #14142b;
    box-shadow: 4px 4px 0 #14142b;
    padding: 16px;
    font-size: 11px;
    line-height: 1.7;
}

#card h3 { margin: 0 0 8px; font-size: 13px; }
#card p { margin: 4px 0; }

#card .row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
}

#card a {
    display: inline-block;
    margin-top: 0;
    background: #ff6a04;
    color: #14142b;
    text-decoration: none;
    border: 4px solid #14142b;
    box-shadow: 3px 3px 0 #14142b;
    padding: 8px 12px;
    font-family: 'Press Start 2P', monospace;
    font-size: 9px;
}

#close {
    position: absolute;
    top: 4px;
    right: 8px;
    background: none;
    border: 0;
    font: inherit;
    font-size: 16px;
    cursor: pointer;
    color: #14142b;
}

  /* ================= CLASSIC (serious) ================= */
  #classic { background: #f4f1de; color: #14142b; font-family: 'Inter', system-ui, sans-serif; min-height: 100vh; }
  #classic h1, #classic h2, #classic h3 { font-family: 'Press Start 2P', monospace; line-height: 1.5; }
  .top { position: sticky; top: 0; z-index: 30; display: flex; align-items: center; gap: 20px; padding: 10px 20px;
         background: #0b0b17; color: #fff; border-bottom: 4px solid #ff6a04; }
  .brand { display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; font-weight: 700; }
  .brand img { width: 38px; }
  .brand small { display: block; font-weight: 400; font-size: 12px; color: #8fd0f2; }
  .logo-band { background: #ff6a04; padding: 14px 20px; }
  .logo-band-in { max-width: 1000px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 16px; }
  .logo-band img { display: block; width: auto; max-width: 100%; image-rendering: auto; }
  .logo-courses { height: 54px; }
  .logo-best { height: 62px; }
  .top nav { display: flex; gap: 18px; margin-left: auto; }
  .top nav a { color: #fff; text-decoration: none; font-size: 14px; }
  .top nav a:hover { color: #ff6a04; }
  .btn { display: inline-block; font-family: 'Inter', system-ui, sans-serif; font-weight: 700; font-size: 14px; cursor: pointer;
         text-decoration: none; background: #ff6a04; color: #14142b; border: 3px solid #14142b; box-shadow: 3px 3px 0 #14142b; padding: 9px 14px; }
  .btn.alt { background: #fff; }
  .btn:active { transform: translate(2px, 2px); box-shadow: 1px 1px 0 #14142b; }

  .hero { background: #1b6ca8 url('/images/sea.svg') 0 0 / 96px 96px; color: #fff; padding: 64px 20px; image-rendering: pixelated; }
  .hero-in { max-width: 1000px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 32px; }
  .hero h1 { font-size: clamp(20px, 4vw, 38px); margin: 0 0 16px; text-shadow: 3px 3px 0 #14142b; }
  .hero p { max-width: 480px; font-size: 17px; line-height: 1.6; text-shadow: 1px 1px 0 #14142b; margin: 0; }
  .chips { display: flex; gap: 10px; flex-wrap: wrap; margin: 18px 0 22px; }
  .chip { background: #0b0b17; color: #fff; padding: 6px 10px; font-size: 12px; font-weight: 600; border: 2px solid #14142b; }
  .hero-img { width: clamp(120px, 22vw, 220px); flex: none; }

  .block { max-width: 1000px; margin: 0 auto; padding: 48px 20px; scroll-margin-top: 70px; }
  .block h2 { font-size: clamp(14px, 2.4vw, 20px); margin: 0 0 24px; }
  .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 18px; }
  .course { background: #fff; border: 4px solid #14142b; box-shadow: 4px 4px 0 #14142b; padding: 16px; display: flex; flex-direction: column; }
  .course h3 { font-size: 12px; margin: 0 0 10px; }
  .course .where { font-weight: 700; margin: 0 0 6px; }
  .course p { margin: 2px 0; font-size: 14px; line-height: 1.5; }
  .course .row { margin-top: auto; padding-top: 14px; display: flex; gap: 10px; flex-wrap: wrap; }

  .steps { counter-reset: s; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; padding: 0; list-style: none; margin: 0; }
  .steps li { counter-increment: s; background: #fff; border: 4px solid #14142b; padding: 16px 16px 16px 60px; position: relative; font-size: 15px; line-height: 1.5; }
  .steps li::before { content: counter(s); position: absolute; left: 14px; top: 12px; width: 32px; height: 32px; display: grid; place-items: center;
                      background: #ff6a04; border: 3px solid #14142b; font-family: 'Press Start 2P', monospace; font-size: 12px; }
  .steps b { display: block; margin-bottom: 4px; }

  /* TESTIMONIALS */
.stories {
    background: #0b0b17;
    color: #fff;
    width: 100%;
}

.stories .block {
    padding-top: 48px;
    padding-bottom: 48px;
}

.story {
    background: #14142b;
    border: 4px solid #8fd0f2;
    padding: 16px;
    font-size: 14px;
    line-height: 1.6;
}

.story strong {
    display: block;
    color: #ff6a04;
    margin-bottom: 6px;
}
  .stories .block { padding-top: 48px; padding-bottom: 48px; }
  .story-list { display: flex; flex-wrap: wrap; justify-content: center; gap: 18px; }
  .story { flex: 0 1 calc((100% - 36px) / 3); min-width: 240px; background: #14142b; border: 4px solid #8fd0f2;
           padding: 16px; font-size: 14px; line-height: 1.6; display: flex; flex-direction: column; gap: 12px; }
  .story strong { display: block; color: #ff6a04; margin-bottom: 2px; }
  .story .where { margin: 0; font-size: 12px; color: #8fd0f2; }
  .story .quote { margin: 0; }
  .story-photo { display: block; width: 100%; aspect-ratio: 1 / 1; object-fit: cover; object-position: center top;
                 border-radius: 12px; background: #0b0b17; image-rendering: auto; }
  .story-avatar { width: 100%; aspect-ratio: 1 / 1; display: grid; place-items: center; border-radius: 12px;
                  background: #0b0b17; border: 3px dashed #8fd0f2; color: #ff6a04;
                  font-family: 'Press Start 2P', monospace; font-size: 40px; }
  @media (max-width: 600px) { .story { flex-basis: 100%; } }

  .contact { font-size: 15px; line-height: 1.8; }
  .contact b { display: inline-block; min-width: 110px; }
  .contact-person { display: flex; align-items: center; gap: 32px; }
  .contact-photo { flex: none; width: 150px; height: 190px; object-fit: cover; object-position: center top;
                   border: 4px solid #14142b; border-radius: 24px; box-shadow: 4px 4px 0 #14142b; }
  .contact-info b { min-width: 170px; }
  .contact-best { margin-top: 32px; }
  @media (max-width: 650px) {
    .contact-person { flex-direction: column; align-items: flex-start; }
    .contact-photo { order: -1; align-self: center; width: 130px; height: 165px; }
  }
  footer.foot { background: #0b0b17; color: #8fd0f2; text-align: center; padding: 22px 20px; font-size: 13px; }

  @media (max-width: 760px) {
    #bubble {
        width: 25%;
        min-height: 12%;
        padding: 1%;
        font-size: 6px;
        line-height: 1.4;
    }

    .logo-band { padding: 10px 14px; }
    .logo-courses { height: 36px; }
    .logo-best { height: 42px; }
    .top { flex-wrap: wrap; gap: 8px 10px; padding: 10px 14px; }
    .brand { min-width: 0; }
    .brand span { font-size: 14px; }
    .brand small { font-size: 11px; }
    .top .play { margin-left: auto; font-size: 12px; padding: 8px 10px; }
    .top nav { order: 3; width: 100%; margin-left: 0; gap: 6px; justify-content: space-between; }
    .top nav a { font-size: 13px; white-space: nowrap; }
    .hero { padding: 40px 20px; }
    .hero-in { flex-direction: column-reverse; align-items: flex-start; }
    .hero-img { width: 110px; }
}
</style>
</head>
<body class="game">

{{-- ============ 1. INTRO ============ --}}
<section id="intro">
  <div class="scene">
    <img class="scene-wide" src="/images/intro-scene.svg" alt="Pirate on a ship looking through a spyglass">
    <div class="stack" aria-hidden="true">
      <div class="panel panel-ship"></div>
      <div class="panel panel-glass"></div>
    </div>
    <div id="bubble"><span id="speech"></span></div>
    <div class="actions">
      <button class="pbtn" id="go" hidden>Let's sail!</button>
      <button class="pbtn alt" id="skip">Classic site</button>
    </div>
  </div>
</section>

{{-- ============ 2. GAME ============ --}}
<section id="sea" hidden>
  <div id="hint">Move the spyglass and find the islands ⚓</div>

  @foreach ($courses as $i => $c)
    <button class="island" data-i="{{ $i }}" style="left: {{ $c['x'] }}%; top: {{ $c['y'] }}%">
      <img src="/images/island.svg" alt="">
      {{ $c['city'] }}
    </button>
  @endforeach

  <div id="lens"><img src="/images/lens-ring.svg" alt=""></div>
  <button class="pbtn alt" id="to-classic">Classic site</button>
</section>

<div id="card" hidden>
  <button id="close" aria-label="Close">×</button>
  <h3 id="c-name"></h3>
  <p id="c-where"></p>
  <p id="c-dates"></p>
  <p id="c-deadline"></p>
  <p id="c-price"></p>
  <div class="row">
    <a id="c-link" href="#" target="_blank" rel="noopener">Explore</a>
    <a id="c-apply" href="#" target="_blank" rel="noopener">Apply</a>
</div>
</div>

{{-- ============ 3. CLASSIC ============ --}}
<div id="classic" hidden>
  <div class="logo-band">
    <div class="logo-band-in">
      <a href="#top"><img class="logo-courses" src="/images/BESTcourses.png" alt="BEST Courses"></a>
      <img class="logo-best" src="/images/BESTlogo.png" alt="BEST Cluj-Napoca">
    </div>
  </div>

  <header class="top">
    <a class="brand" href="#top">
      <img src="/images/island.svg" alt="">
      <span>BEST Cluj-Napoca <small>Spring Courses</small></span>
    </a>
    <nav>
      <a href="#courses">Courses</a>
      <a href="#apply">How to apply</a>
      <a href="#stories">Stories</a>
      <a href="#contact">Contact</a>
    </nav>
    <button class="btn play" id="to-game">Play the pirate game</button>
  </header>

  <main id="top">
    <section class="hero">
      <div class="hero-in">
        <div>
          <h1>Spring Courses</h1>
          <p>Pick a city, spend a couple of days learning something new and meet students from all over Europe.</p>
          <div class="chips">
            <span class="chip">{{ count($courses) }} courses</span>
            <span class="chip">{{ collect($courses)->pluck('country')->unique()->count() }} countries</span>
          </div>
          <a class="btn" href="#courses">See all courses</a>
        </div>
        <img class="hero-img" src="/images/island.svg" alt="">
      </div>
    </section>

    <section class="block" id="courses">
      <h2>All courses</h2>
      <div class="grid">
        @foreach ($courses as $c)
          <article class="course">
            <h3>{{ $c['name'] }}</h3>
            <p class="where">{{ $c['city'] }}, {{ $c['country'] }}</p>
            <p>{{ $c['dates'] }}</p>
            <p>Apply by {{ $c['deadline'] }}</p>
            <p>Price: {{ $c['price'] }}</p>
            <div class="row">
              <a class="btn" href="{{ $c['apply'] ?? '#' }}">Apply</a>
              <a class="btn alt" target="_blank" rel="noopener"
                 href="https://www.google.com/maps/@?api=1&map_action=pano&viewpoint={{ $c['lat'] }},{{ $c['lng'] }}"> View</a>
            </div>
          </article>
        @endforeach
      </div>
    </section>

    <section class="block" id="apply">
      <h2>How to apply</h2>
      <ol class="steps">
        <li><b>Choose a course</b>Browse the list and pick the topic and city you like.</li>
        <li><b>Write a motivational letter</b>Tell us why you want to go and what you will bring.</li>
        <li><b>Apply and wait</b>Send your application before the deadline and wait for the selection results.</li>
      </ol>
    </section>

    <section class="stories" id="stories">
      <div class="block">
        <h2>Stories</h2>

        {{-- Edit the stories here. 'photo' is optional: leave it null (or the file missing) and a letter avatar is shown. --}}
        @php
          $stories = [
            ['name' => 'Sabina Bucea', 'where' => 'City, Country', 'photo' => 'images/Sabina.jpg.jpeg',
             'quote' => 'Replace this with a real story from a past participant.Replace this with a real story from a past participant.Replace this with a real story from a past participant.'],
            ['name' => 'Alexia Adam', 'where' => 'City, Country', 'photo' => 'images/alexia.jpeg',
             'quote' => 'Replace this with a real story from a past participant.Replace this with a real story from a past participant.Replace this with a real story from a past participant.'],
            ['name' => 'Catinca Iacob', 'where' => 'City, Country', 'photo' => 'images/catinca.jpeg',
             'quote' => 'Replace this with a real story from a past participant.Replace this with a real story from a past participant.Replace this with a real story from a past participant.'],
            ['name' => 'Student name', 'where' => 'City, Country', 'photo' => null,
             'quote' => 'Replace this with a real story from a past participant.Replace this with a real story from a past participant.Replace this with a real story from a past participant.'],
            ['name' => 'Student name', 'where' => 'City, Country', 'photo' => null,
             'quote' => 'Replace this with a real story from a past participant.Replace this with a real story from a past participant.Replace this with a real story from a past participant.'],
          ];
        @endphp

        <div class="story-list">
          @foreach ($stories as $s)
            <article class="story">
              @if (!empty($s['photo']) && file_exists(public_path($s['photo'])))
                <img class="story-photo" src="/{{ $s['photo'] }}" alt="{{ $s['name'] }}" loading="lazy">
              @else
                <div class="story-avatar" aria-hidden="true">{{ strtoupper(mb_substr($s['name'], 0, 1)) }}</div>
              @endif
              <div>
                <strong>{{ $s['name'] }}</strong>
                <p class="where">{{ $s['where'] }}</p>
              </div>
              <p class="quote">{{ $s['quote'] }}</p>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    
<section class="block contact" id="contact">
    <h2>Contact</h2>

    <div class="contact-person">
        <div class="contact-info">
            <p><b>Vivaldi Responsible:</b> Pohl Adam</p>
            <p><b>Email:</b> adam.pohl@bestcj.ro</p>
            <p><b>Phone:</b> +40 771 567 623</p>
            <p><b>Instagram:</b> adam._.pohl2411</p>
        </div>

        <img src="/images/adam.jpg" alt="Pohl Adam - Main Organiser" class="contact-photo">
    </div>

    <div class="contact-best">
        <p><b>BEST Cluj-Napoca</b></p>
        <p>Str. Constantin Daicoviciu Nr. 15, Bloc turn, Cam. 708</p>
        <p>400020 Cluj-Napoca, jud. Cluj</p>
        <p>C.P. 821 O.P. 12</p>
        <p>ROMANIA</p>
        <p>cluj@BEST.eu.org</p>
        <p>Web page: bestcj.ro</p>
    </div>
</section>

  </main>

  <footer class="foot">BEST Cluj-Napoca ·  Courses</footer>
</div>

<script>
  const courses = @json($courses);
  const $ = (s) => document.querySelector(s);
  const lens = $('#lens');

  function moveLens(x, y) { lens.style.left = x + 'px'; lens.style.top = y + 'px'; }

  // mode: 'intro' | 'game' | 'classic'
  function show(mode) {
    $('#intro').hidden = mode !== 'intro';
    $('#sea').hidden = mode !== 'game';
    $('#classic').hidden = mode !== 'classic';
    $('#card').hidden = true;
    document.body.className = mode === 'classic' ? 'classic' : 'game';
    window.scrollTo(0, 0);
    if (mode === 'game') moveLens(innerWidth / 2, innerHeight / 2);
    history.replaceState(null, '', mode === 'classic' ? '#classic' : location.pathname);
  }

  // pirate dialog, letter by letter
  const text = 'AHOY! AHOY! Welcome to BEST Courses aboard!';
  let n = 0;
  const timer = setInterval(() => {
    $('#speech').textContent = text.slice(0, ++n);
    if (n >= text.length) { clearInterval(timer); $('#go').hidden = false; }
  }, 45);

  $('#go').onclick = () => show('game');
  $('#skip').onclick = () => show('classic');
  $('#to-classic').onclick = () => show('classic');
  $('#to-game').onclick = () => { show('intro'); $('#go').hidden = false; $('#speech').textContent = text; };

  // spyglass follows the mouse / finger
  const sea = $('#sea');
  sea.addEventListener('pointermove', (e) => moveLens(e.clientX, e.clientY));
  sea.addEventListener('pointerdown', (e) => moveLens(e.clientX, e.clientY));

  // click an island -> card
  document.querySelectorAll('.island').forEach((b) => {
    b.onclick = () => {
      const c = courses[b.dataset.i];
      $('#c-name').textContent = c.name;
      $('#c-where').textContent = c.city + ', ' + c.country;
      $('#c-dates').textContent = c.dates;
      $('#c-deadline').textContent = 'Apply by ' + c.deadline;
      $('#c-price').textContent = 'Price: ' + c.price;
      $('#c-link').textContent = 'Explore';
      $('#c-link').href = 'https://www.google.com/maps/@?api=1&map_action=pano&viewpoint=' + c.lat + ',' + c.lng;

      $('#c-apply').href = c.apply || '#';
      $('#card').hidden = false;
    };
  });
  $('#close').onclick = () => { $('#card').hidden = true; };

  // direct link to the serious version: /#classic
  if (location.hash === '#classic') show('classic');
</script>
</body>
</html>
