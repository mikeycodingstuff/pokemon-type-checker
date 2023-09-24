<div class='flex justify-center items-center h-screen'>
    <div class='p-4 bg-indigo-400 w-fit rounded'>
        <h1 class='text-center text-3xl'>pokémon type checker</h1>
        <div class='my-4 p-2 bg-indigo-300 rounded'>
            <div class='p-2 flex justify-between'>
                <label
                    class='whitespace-nowrap self-center'
                    for='attackingType'
                >
                    attacking type:
                </label>
                <select
                    class='p-1 px-2 rounded bg-indigo-50 text-center'
                    wire:model='attackingType'
                    id='attackingType'
                >
                    @foreach ($types as $type)
                        <option>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='p-2 flex justify-between'>
                <label
                    class='whitespace-nowrap self-center'
                    for='defendingType'
                >
                    defending type:
                </label>
                <select
                    class='p-1 px-2 rounded bg-indigo-50 text-center'
                    wire:model='defendingType'
                    id='defendingType'
                >
                    @foreach ($types as $type)
                        <option>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class='my-3 flex justify-center'>
                <button
                    class='text-indigo-50 rounded px-3 py-2 bg-indigo-500 hover:bg-indigo-600 transition-colors duration-300'
                    wire:click='checkTypeEffectiveness'
                >
                    check
                </button>
            </div>
        </div>
        <div class='mt-4 flex flex-col justify-between text-2xl {{ $result ? 'gap-2' : '' }}'>
            <span>type effectiveness: </span>
            @if ($result)
                <span>{{ "$result!" }}</span>
            @endif
        </div>
    </div>
</div>
