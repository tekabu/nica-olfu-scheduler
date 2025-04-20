<form class="form-entry">
    @if (isset($row))
        <input type="hidden" name="id" value="{{ $row->id }}">
    @endif

    @php
        $uuid_department = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_department }}" class="form-label">Department<span class="required"> *</span></label>
            <select id="{{ $uuid_department }}" name="department_id" required="required" class="form-control">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ isset($row) && $row->department_id == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @php
        $uuid_title = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_title }}" class="form-label">Title<span class="required"> *</span></label>
            <input id="{{ $uuid_title }}" name="title" placeholder="Title" required="required" type="text"
                value="{{ $row->title ?? '' }}" class="form-control">
        </div>
    </div>

    @php
        $uuid_description = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_description }}" class="form-label">Description</label>
            <textarea id="{{ $uuid_description }}" name="description" placeholder="Description" required="required"
                class="form-control">{{ $row->description ?? '' }}</textarea>
        </div>
    </div>

    @php
        $uuid_started_date = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_started_date }}" class="form-label">Start Date<span class="required"> *</span></label>
            <input id="{{ $uuid_started_date }}" name="started_date" placeholder="Start Date" required="required" type="text"
                value="{{ $row->started_date ?? '' }}" class="form-control datepicker-input">
        </div>
    </div>

    @php
        $uuid_ended_date = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_ended_date }}" class="form-label">End Date<span class="required"> *</span></label>
            <input id="{{ $uuid_ended_date }}" name="ended_date" placeholder="End Date" required="required" type="text"
                value="{{ $row->ended_date ?? '' }}" class="form-control datepicker-input">
        </div>
    </div>

    @php
        $uuid_completed_date = Str::uuid();
    @endphp

    <div class="mb-3">
        <div class="form-group">
            <label for="{{ $uuid_completed_date }}" class="form-label">Completed Date</label>
            <input id="{{ $uuid_completed_date }}" name="completed_date" placeholder="Completed Date" type="text"
                value="{{ $row->completed_date ?? '' }}" class="form-control datepicker-input">
        </div>
    </div>
</form>