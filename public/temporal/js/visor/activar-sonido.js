let sonidoActivo = false;
let audioCtx = null;


function toggleSonido() {
    if (sonidoActivo) {
        desactivarSonido();
    } else {
        activarSonido();
    }
}

function activarSonido() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    if (audioCtx.state === 'suspended') audioCtx.resume();
    // "Despertar" el motor de voz del navegador con un utterance mudo — algunos navegadores
    // (sobre todo en TVs/Android) necesitan esto dentro del mismo gesto de clic del usuario.
    const u = new SpeechSynthesisUtterance('Sistema de llamado activado - CEO SALUD');
    u.volume = 100;
    speechSynthesis.speak(u);
    sonidoActivo = true;
    actualizarBotonSonido();
}

function desactivarSonido() {
    sonidoActivo = false;
    speechSynthesis.cancel(); // corta cualquier locución en curso
    actualizarBotonSonido();
}

function actualizarBotonSonido() {
    const btn = document.getElementById('soundToggle');
    const label = document.getElementById('soundToggleLabel');
    const icon = btn.querySelector('.icon');
    if (sonidoActivo) {
        btn.classList.remove('off');
        btn.classList.add('on');
        icon.textContent = '🔊';
        label.textContent = 'Llamado por voz activado';
    } else {
        btn.classList.remove('on');
        btn.classList.add('off');
        icon.textContent = '🔇';
        label.textContent = 'Activar llamado por voz';
    }
}


function tick() {
    document.getElementById('clock').textContent =
        new Date().toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit' });
}
setInterval(tick, 1000); tick();

