@extends ('layoutLecturer')

@section('title', 'Test List')

@section('content')
<link rel="stylesheet" href="{{asset('css/test-list.css')}}">

<div class="course-header">
    <div class="course-info-container">
        <div class="course-info-box">
            <div class="course-label">Course Code</div>
            <div class="course-value">{{ $testSlots[0]->course_code ?? 'N/A' }}</div>
        </div>
        <div class="course-info-box">
            <div class="course-label">Course Name</div>
            <div class="course-value">{{ $testSlots[0]->course_name ?? 'N/A' }}</div>
        </div>
    </div>
</div>

    <!-- Test Slots Card -->
    <div class="card">
        <div class="card-header">
            Test Slots
            <a href="/add/test" class="btn btn-success btn-sm float-end">Add New Test Slot</a>
        </div>
        @if (Session::has('success'))
            <span class="alert alert-success p-2">{{ Session::get('success') }}</span>
        @endif
        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">{{ Session::get('fail') }}</span>
        @endif
        <div class="card-body">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <th>No.</th>
                    <th>Capacity</th>
                    <th>Exam Date</th>
                    <th>Duration</th>
                    <th>Time</th>
                    <th>Test Type</th>
                    <th>Type</th>
                    <th>Venue</th>
                    <th>Test Paper</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if (count($testSlots) > 0)
                        @foreach ($testSlots as $item)
                            <tr class="{{ $item->is_clashing ? 'table-danger' : '' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->capacity }}</td>
                                <td>{{ $item->exam_date }}</td>
                                <td>{{ $item->duration }}</td>
                                <td>{{ $item->selected_time }}</td>
                                <td>{{ $item->exam_type }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->venue_short }}</td>
                                <td class="text-center">
                                    @if ($item->file_path)
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">
                                            <img src="{{ asset('images/file.png') }}" alt="File Logo" class="file-icon"/>
                                        </a>
                                    @else
                                        No File
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="/delete/{{ $item->id }}" target="_blank">
                                        <img src="{{ asset('images/delete.webp') }}" alt="Bin Logo" class="action-icon"/>
                                    </a>
                                </td>
                            </tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">No Test Slots Found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
export default {
    data() {
        return {
            filePath: '',
        };
    },
    methods: {
        async uploadFile() {
            const fileInput = this.$refs.file;
            if (fileInput.files.length === 0) {
                alert('Please select a file.');
                return;
            }

            const formData = new FormData();
            formData.append('file', fileInput.files[0]);

            try {
                const response = await axios.post(`/tests/${this.testId}/upload`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                this.filePath = response.data.file_path;
                alert('File uploaded successfully.');
            } catch (error) {
                console.error(error);
                alert('File upload failed.');
            }
        },
    },
};
</script>
@endsection