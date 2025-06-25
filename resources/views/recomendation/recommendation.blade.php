<style>
    .activity-checkboxes {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        margin-top: 10px;
    }

    .form-check {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }

    .form-check-input {
        margin-top: 0.3rem;
    }
</style>
<!-- resources/views/travel/recommendation.blade.php -->
<form action="{{ route('travel.recommend') }}" method="POST">
    @csrf
    <!-- Input budget -->
    <div>
        <label for="min_budget">Minimal Budget (Rp):</label>
        <input type="number" name="min_budget" id="min_budget" required>
    </div>
    <div>
        <label for="max_budget">Maksimal Budget (Rp):</label>
        <input type="number" name="max_budget" id="max_budget" required>
    </div>

    <!-- Input durasi -->
    <div>
        <label for="min_duration">Minimal Durasi (hari):</label>
        <input type="number" name="min_duration" id="min_duration" required>
    </div>
    <div>
        <label for="max_duration">Maksimal Durasi (hari):</label>
        <input type="number" name="max_duration" id="max_duration" required>
    </div>

    <!-- Input aktivitas (checkbox) -->
    <div>
        <label>Pilih Aktivitas:</label>
        <div class="activity-checkboxes">
            @foreach ($activities as $activity)
                <div class="form-check">
                    <input type="checkbox" name="activities[]" id="activity-{{ $activity->id }}"
                        value="{{ $activity->id }}" class="form-check-input"
                        {{ in_array($activity->id, old('activities', [])) ? 'checked' : '' }}>
                    <label for="activity-{{ $activity->id }}" class="form-check-label">
                        {{ $activity->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit">Dapatkan Rekomendasi</button>
</form>
