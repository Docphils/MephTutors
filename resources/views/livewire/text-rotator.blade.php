<div class="relative flex mx-auto items-baseline rounded-lg justify-center mt-5 text-2xl text-cyan-300 font-bold gap-1">
    Your one-stop solution for
    <div class="text-container flex text-2xl bg-cyan-800 rounded-lg p-1 text-cyan-200">
        <span wire:poll.5s="showNextText">
            {{ $currentText }}
        </span>
    </div>
</div>
