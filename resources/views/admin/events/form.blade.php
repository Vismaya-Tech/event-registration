<div class="surface-card p-4 p-lg-5">
    <form method="POST" action="{{ $action }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="row g-4">
            <div class="col-12">
                <label for="name" class="form-label">Event name <span class="required-mark" aria-hidden="true">*</span></label>
                <input type="text" name="name" id="name" placeholder="e.g. Community Tech Meetup"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $event?->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Keep it short and recognisable for attendees.</div>
            </div>

            <div class="col-md-6">
                <label for="event_date" class="form-label">Event date <span class="required-mark" aria-hidden="true">*</span></label>
                <input type="date" name="event_date" id="event_date"
                       class="form-control @error('event_date') is-invalid @enderror"
                       value="{{ old('event_date', $event?->event_date?->toDateString()) }}" required>
                @error('event_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Visible on the public event card.</div>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Description <span class="required-mark" aria-hidden="true">*</span></label>
                <textarea name="description" id="description" rows="5"
                          placeholder="Tell attendees what to expect."
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $event?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">A short summary is enough. Attendees see this before registering.</div>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-3 mt-4 pt-3 border-top">
            <button type="submit" class="btn btn-primary px-4">Save event</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
