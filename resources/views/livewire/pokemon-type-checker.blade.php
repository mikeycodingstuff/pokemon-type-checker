<div class='flex justify-center items-center h-screen'>
    <div class='p-4 bg-indigo-700'>
        <h1>Pokémon Type Checker</h1>
        <div class='my-4 p-2 bg-indigo-400 text-slate-900'>
            <label for="attackingType">Attacking Type:</label>
            <input
                wire:model='attackingType'
                type="text"
                id="attackingType"
            >
        </div>
        <div class='my-4 p-2 bg-indigo-400 text-slate-900'>
            <label for="defendingType">Defending Type:</label>
            <input
                wire:model='defendingType'
                type="text"
                id="defendingType"
            >
        </div>
        <button class='border rounded p-2 border-slate-200' wire:click='checkTypeEffectiveness'>Check Type Effectiveness</button>
        <div class='mt-4'>
            <p>Type Effectiveness: {{ $result }}</p>
        </div>
    </div>
</div>
