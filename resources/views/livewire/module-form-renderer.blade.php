<div class="glass-card">
    @if (session()->has('status'))
        <div class="mb-4 glass-surface px-4 py-3 text-sm text-app">
            {{ session('status') }}
        </div>
    @endif

    @php
        $steps = $this->getSteps();
        $totalSteps = count($steps);
    @endphp

    @if ($totalSteps === 0)
        <div class="text-sm text-slate-600">No form schema configured.</div>
    @else
        <div class="flex flex-wrap gap-2">
            @foreach ($steps as $index => $step)
                <div class="{{ $index === $currentStep ? 'glass-badge' : 'glass-badge opacity-70' }}">
                    Step {{ $index + 1 }}
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            @foreach ($steps as $index => $step)
                @if ($index === $currentStep)
                    <div class="space-y-4">
                        <div class="text-lg font-semibold text-app">{{ $step['title'] ?? ('Step '.($index + 1)) }}</div>

                        @foreach ($step['fields'] ?? [] as $field)
                            @if (! $this->isFieldVisible($field))
                                @continue
                            @endif

                            @switch($field['type'] ?? 'text')
                                @case('textarea')
                                    <label class="block text-sm font-medium text-app">
                                        {{ $field['label'] ?? $field['name'] }}
                                        <textarea
                                            class="glass-input mt-2"
                                            rows="4"
                                            wire:model="formState.{{ $field['name'] }}"
                                        ></textarea>
                                    </label>
                                    @break
                                @case('select')
                                    <label class="block text-sm font-medium text-app">
                                        {{ $field['label'] ?? $field['name'] }}
                                        <select
                                            class="glass-input mt-2"
                                            wire:model="formState.{{ $field['name'] }}"
                                        >
                                            <option value="">Select...</option>
                                            @foreach ($field['options'] ?? [] as $optionValue => $optionLabel)
                                                <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @break
                                @case('checkbox')
                                    <label class="flex items-center gap-2 text-sm font-medium text-app">
                                        <input
                                            type="checkbox"
                                            class="rounded border-slate-300 text-slate-900 focus:ring-slate-500"
                                            wire:model="formState.{{ $field['name'] }}"
                                        >
                                        {{ $field['label'] ?? $field['name'] }}
                                    </label>
                                    @break
                                @case('repeater')
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <div class="text-sm font-medium text-app">{{ $field['label'] ?? $field['name'] }}</div>
                                            <button
                                                class="glass-btn text-xs"
                                                type="button"
                                                wire:click="addRepeaterItem('{{ $field['name'] }}')"
                                            >
                                                Add item
                                            </button>
                                        </div>
                                        @forelse ($formState[$field['name']] ?? [] as $itemIndex => $item)
                                            <div class="glass-surface rounded-lg p-4">
                                                <div class="space-y-3">
                                                    @foreach ($field['itemSchema'] ?? [] as $itemField)
                                                        @switch($itemField['type'] ?? 'text')
                                                            @case('textarea')
                                                                <label class="block text-sm font-medium text-app">
                                                                    {{ $itemField['label'] ?? $itemField['name'] }}
                                                                    <textarea
                                                                        class="glass-input mt-2"
                                                                        rows="3"
                                                                        wire:model="formState.{{ $field['name'] }}.{{ $itemIndex }}.{{ $itemField['name'] }}"
                                                                    ></textarea>
                                                                </label>
                                                                @break
                                                            @case('select')
                                                                <label class="block text-sm font-medium text-app">
                                                                    {{ $itemField['label'] ?? $itemField['name'] }}
                                                                    <select
                                                                        class="glass-input mt-2"
                                                                        wire:model="formState.{{ $field['name'] }}.{{ $itemIndex }}.{{ $itemField['name'] }}"
                                                                    >
                                                                        <option value="">Select...</option>
                                                                        @foreach ($itemField['options'] ?? [] as $optionValue => $optionLabel)
                                                                            <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </label>
                                                                @break
                                                            @default
                                                                <label class="block text-sm font-medium text-app">
                                                                    {{ $itemField['label'] ?? $itemField['name'] }}
                                                                    <input
                                                                        class="glass-input mt-2"
                                                                        type="{{ $itemField['type'] ?? 'text' }}"
                                                                        wire:model="formState.{{ $field['name'] }}.{{ $itemIndex }}.{{ $itemField['name'] }}"
                                                                    >
                                                                </label>
                                                        @endswitch
                                                    @endforeach
                                                </div>
                                                <button
                                                    class="mt-3 text-xs font-semibold text-rose-300 hover:text-rose-200"
                                                    type="button"
                                                    wire:click="removeRepeaterItem('{{ $field['name'] }}', {{ $itemIndex }})"
                                                >
                                                    Remove item
                                                </button>
                                            </div>
                                        @empty
                                            <div class="glass-surface rounded-lg p-4 text-sm text-muted">
                                                No items yet. Add one to continue.
                                            </div>
                                        @endforelse
                                    </div>
                                    @break
                                @default
                                    <label class="block text-sm font-medium text-app">
                                        {{ $field['label'] ?? $field['name'] }}
                                        <input
                                            class="glass-input mt-2"
                                            type="{{ $field['type'] ?? 'text' }}"
                                            wire:model="formState.{{ $field['name'] }}"
                                        >
                                    </label>
                            @endswitch
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>

        <div class="mt-6 flex items-center justify-between">
            <button
                class="glass-btn"
                type="button"
                wire:click="previousStep"
                @if ($currentStep === 0) disabled @endif
            >
                Back
            </button>
            @if ($currentStep < ($totalSteps - 1))
                <button
                    class="glass-btn glass-btn-primary"
                    type="button"
                    wire:click="nextStep"
                >
                    Next
                </button>
            @else
                <button
                    class="glass-btn glass-btn-primary"
                    type="button"
                    wire:click="submit"
                >
                    Submit
                </button>
            @endif
        </div>
    @endif
</div>
