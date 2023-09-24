<div class='flex justify-center items-center h-screen'>
    <div class='p-4 bg-indigo-700'>
        <h1>Pokémon Type Checker</h1>
        <div class='my-4 p-2 bg-indigo-400 text-slate-900'>
            <div class='p-2 flex justify-between'>
                <label for='attackingType'>Attacking Type:</label>
                <input
                    class='ml-2 rounded'
                    wire:model='attackingType'
                    type='text'
                    id='attackingType'
                >
            </div>
            <div class='p-2 flex justify-between'>
                <label for='defendingType'>Defending Type:</label>
                <input
                    class='ml-2 rounded'
                    wire:model='defendingType'
                    type='text'
                    id='defendingType'
                >
            </div>
        </div>
        <button
            class='border rounded p-2 border-slate-200'
            wire:click='checkTypeEffectiveness'
        >Check Type Effectiveness</button>
        <div class='mt-4'>
            <p>Type Effectiveness: {{ $result }}</p>
        </div>
    </div>
</div>
