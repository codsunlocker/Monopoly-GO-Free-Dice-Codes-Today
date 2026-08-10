<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit; }
require_once "config.php";

$stats = [
  ['label'=>'Total Clicks','value'=>'29,796','delta'=>'+12.8%','icon'=>'↗'],
  ['label'=>'Clicks (Current Period)','value'=>'10,874','delta'=>'+8.4%','icon'=>'◌'],
  ['label'=>'Clicks (Today)','value'=>'794','delta'=>'+5.2%','icon'=>'◷'],
  ['label'=>'Revenue','value'=>'$842.50','delta'=>'+18.7%','icon'=>'$']
];
$days = ['25 Jan','26 Jan','27 Jan','28 Jan','29 Jan','30 Jan','31 Jan','01 Feb','02 Feb','03 Feb','04 Feb','05 Feb','06 Feb','07 Feb','08 Feb'];
$bars = [1060,520,1090,900,675,365,1090,590,585,510,840,500,585,675,790];

$activity = [
 ['title'=>'Waste Management Work From Job…','time'=>'3 seconds ago','country'=>'Sweden','device'=>'Android','browser'=>'Chrome','ref'=>'facebook.com','lang'=>'EN'],
 ['title'=>'Waste Management Work From Job…','time'=>'4 seconds ago','country'=>'Sweden','device'=>'Windows 10/11','browser'=>'Firefox','ref'=>'facebook.com','lang'=>'EN'],
 ['title'=>'Waste Management Work From Job…','time'=>'17 seconds ago','country'=>'Ireland','device'=>'Android','browser'=>'Chrome','ref'=>'facebook.com','lang'=>'EN'],
 ['title'=>'Waste Management Work From Job…','time'=>'21 seconds ago','country'=>'United States','device'=>'Windows 10/11','browser'=>'Edge','ref'=>'facebook.com','lang'=>'EN']
];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>SmartLink • Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app">
<aside class="sidebar" id="sidebar">
  <div class="brand"><div class="brand-mark small">S</div><span>SmartLink</span></div>
  <nav>
    <a class="active" href="dashboard.php">⌂ <span>Dashboard</span></a>
    <a href="dashboard.php">▥ <span>Analytics</span></a>
    <div class="nav-title">CHANNELS</div>
    <a href="dashboard.php">◇ <span>Campaigns</span></a>
    <a href="dashboard.php">↗ <span>Smart Links</span></a>
    <div class="nav-title">LINK MANAGER</div>
    <a href="dashboard.php">⌁ <span>All Links</span></a>
    <a href="dashboard.php">▣ <span>Offers</span></a>
    <a href="dashboard.php">◷ <span>Events</span></a>
    <div class="nav-title">ANALYTICS</div>
    <a href="dashboard.php">◎ <span>Geo Analytics</span></a>
    <a href="dashboard.php">▥ <span>Devices</span></a>
    <a href="dashboard.php">↗ <span>Traffic Sources</span></a>
    <a href="dashboard.php">↻ <span>Conversions</span></a>
    <a href="dashboard.php">＄ <span>Revenue</span></a>
    <div class="nav-title">PLATFORM</div>
    <a href="dashboard.php">♙ <span>Publishers</span></a>
    <a href="dashboard.php">▣ <span>Payouts</span></a>
    <a href="dashboard.php">⚿ <span>Fraud & Security</span></a>
    <a href="dashboard.php">☷ <span>Reports</span></a>
    <a href="dashboard.php">♢ <span>Notifications</span></a>
    <a href="dashboard.php">⚙ <span>Settings</span></a>
    <a href="dashboard.php">☰ <span>Activity Logs</span></a>
  </nav>
</aside>

<main class="main">
<header class="topbar">
  <button class="icon-btn mobile-menu" onclick="toggleSidebar()">☰</button>
  <div class="search"><span>⌕</span><input placeholder="Quick search…"><kbd>CTRL</kbd><kbd>K</kbd></div>
  <div class="top-actions"><button class="icon-btn">◔</button><button class="icon-btn">♢</button><div class="avatar">A</div></div>
</header>

<div class="content">
  <div class="page-head">
    <div><h1>Dashboard</h1><p>Traffic overview and recent activity</p></div>
    <button class="btn primary" onclick="alert('Create Smart Link form can be connected to PHP/MySQL next.')">＋ Create Smart Link</button>
  </div>

  <section class="card traffic-card">
    <div class="section-head">
      <h2>Traffic Overview</h2>
      <div class="date-box">▣ 01/25/2026 - 02/08/2026</div>
    </div>
    <div class="stat-row">
      <?php foreach($stats as $s): ?>
      <div class="stat"><div class="stat-label"><?= e($s['label']) ?></div><div class="stat-value"><?= e($s['value']) ?></div><div class="stat-delta"><?= e($s['icon']) ?> <?= e($s['delta']) ?></div></div>
      <?php endforeach; ?>
    </div>
    <div class="chart-wrap"><canvas id="trafficChart"></canvas></div>
  </section>

  <div class="grid-two">
    <section class="card shorten">
      <div class="section-head"><h2>Shorten Link</h2><span class="muted">Single / Multiple</span></div>
      <div class="shorten-form"><input id="longUrl" type="url" placeholder="Paste a long link"><button class="btn primary" onclick="shortenDemo()">Shorten</button></div>
      <div id="shortResult" class="short-result"></div>
    </section>

    <section class="card">
      <div class="section-head"><h2>Recent Activity</h2><button class="more">•••</button></div>
      <div class="activity-list">
      <?php foreach($activity as $a): ?>
        <div class="activity">
          <div class="activity-title"><span class="dot"></span><b><?= e($a['title']) ?></b><small><?= e($a['time']) ?></small></div>
          <div class="activity-meta"><span>🌐 <?= e($a['country']) ?></span><span>▣ <?= e($a['device']) ?></span><span>◉ <?= e($a['browser']) ?></span></div>
          <div class="activity-meta"><span>↗ <?= e($a['ref']) ?></span><span>♙ <?= e($a['lang']) ?></span></div>
        </div>
      <?php endforeach; ?>
      </div>
    </section>
  </div>

  <section class="card">
    <div class="section-head"><h2>Recent Links</h2><div class="link-tools"><button class="btn ghost">☑ Actions⌄</button><button class="icon-btn">⌕</button></div></div>
    <div class="table">
      <div class="table-row table-head"><span>LINK</span><span>CLICKS</span><span>UNIQUE</span><span>RULES</span><span>STATUS</span></div>
      <div class="table-row"><span><b>Amazon Work From Job Part Time and Full Time</b><small>https://demo.local/xSNDl</small></span><span>1</span><span>1</span><span><i class="pill">Geo Targeted</i> <i class="pill">Device Targeted</i></span><span><i class="status live">Active</i></span></div>
      <div class="table-row"><span><b>Waste Management Work From Job</b><small>https://demo.local/ugXMi</small></span><span>125</span><span>98</span><span><i class="pill">Geo Targeted</i></span><span><i class="status live">Active</i></span></div>
      <div class="table-row"><span><b>USA Remote Jobs</b><small>https://demo.local/PBK7</small></span><span>680</span><span>542</span><span><i class="pill">Device Targeted</i></span><span><i class="status live">Active</i></span></div>
    </div>
  </section>

  <div class="mini-grid">
    <section class="card"><h2>Top Countries</h2><div class="bars"><div><span>🇺🇸 United States</span><b>42%</b></div><div><span>🇬🇧 United Kingdom</span><b>18%</b></div><div><span>🇨🇦 Canada</span><b>11%</b></div><div><span>🇮🇪 Ireland</span><b>8%</b></div></div></section>
    <section class="card"><h2>Devices</h2><div class="bars"><div><span>📱 Mobile</span><b>64%</b></div><div><span>💻 Desktop</span><b>31%</b></div><div><span>▣ Tablet</span><b>5%</b></div></div></section>
    <section class="card"><h2>Security Alerts</h2><div class="alert-line"><span class="warn">!</span><div><b>3 suspicious clicks</b><small>Review recommended</small></div></div><div class="alert-line"><span class="safe">✓</span><div><b>No critical incidents</b><small>Last scan 2 min ago</small></div></div></section>
  </div>
</div>
</main>
</div>
<script>
const labels = <?= json_encode($days) ?>;
const data = <?= json_encode($bars) ?>;
new Chart(document.getElementById('trafficChart'), {
  type:'bar',
  data:{labels, datasets:[{label:'Clicks',data,borderWidth:1,borderRadius:4}]},
  options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},
    scales:{x:{grid:{display:false},ticks:{color:'#8e96a8'}},y:{beginAtZero:true,grid:{color:'#20242c'},ticks:{color:'#8e96a8'}}}}
});
function toggleSidebar(){document.getElementById('sidebar').classList.toggle('open')}
function shortenDemo(){
  const u=document.getElementById('longUrl').value.trim();
  const r=document.getElementById('shortResult');
  if(!u){r.textContent='Enter a destination URL first.';return;}
  r.innerHTML='<b>Demo short link:</b> https://demo.local/'+Math.random().toString(36).slice(2,8);
}
</script>
</body>
</html>