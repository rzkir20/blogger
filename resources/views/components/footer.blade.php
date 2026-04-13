<footer class="bg-black text-white p-8 lg:p-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <div class="lg:col-span-6">
            <h2 class="font-black text-7xl lg:text-9xl uppercase leading-[0.8] tracking-tighter mb-8">Subscribe <br> or Die.</h2>
            <p class="font-mono text-sm max-w-md uppercase mb-8">
                Join the network. Get the raw data. No marketing fluff. Just editorial integrity delivered to your inbox weekly.
            </p>
            <form class="flex border-2 border-white">
                <input type="email" placeholder="ENTER_EMAIL_HERE" class="flex-1 bg-transparent p-4 font-mono text-sm focus:outline-none">
                <button class="px-8 bg-white text-black font-black uppercase hover:bg-red-600 hover:text-white transition-colors" type="submit">Connect</button>
            </form>
        </div>

        <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
            <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Navigation</h4>
            <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                <li><a href="{{ url('/') }}" id="f-home" class="hover:text-red-600 transition-colors">Index</a></li>
                <li><a href="#" id="f-authors" class="hover:text-red-600 transition-colors">Contributors</a></li>
                <li><a href="#" id="f-manifesto" class="hover:text-red-600 transition-colors">Manifesto</a></li>
                <li><a href="#" id="f-legal" class="hover:text-red-600 transition-colors">Protocols</a></li>
            </ul>
        </div>

        <div class="lg:col-span-3 lg:border-l border-white/20 lg:pl-12">
            <h4 class="font-mono text-xs uppercase mb-8 opacity-40">Social Protocols</h4>
            <ul class="space-y-4 font-black text-2xl uppercase tracking-tighter">
                <li><a href="#" id="f-twt" class="hover:text-red-600 transition-colors">Twitter</a></li>
                <li><a href="#" id="f-inst" class="hover:text-red-600 transition-colors">Instagram</a></li>
                <li><a href="#" id="f-git" class="hover:text-red-600 transition-colors">Github</a></li>
            </ul>
        </div>
    </div>

    <div class="mt-32 pt-8 border-t border-white/20 flex justify-between items-center font-mono text-[10px] uppercase">
        <span>Archive Editorial (c) {{ date('Y') }} / Node_v1.0.1</span>
        <span class="flex gap-8">
            <span>Privacy_Policy</span>
            <span>Term_Conditions</span>
        </span>
    </div>
</footer>

<script>
    (function () {
        const btn = document.getElementById('mode-toggle');
        const root = document.getElementById('root');
        if (!btn || !root) return;

        btn.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            root.classList.toggle('dark-mode');
        });
    })();
</script>
