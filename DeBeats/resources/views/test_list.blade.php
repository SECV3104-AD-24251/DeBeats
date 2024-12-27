@extends ('layoutLecturer')

@section('title', 'Test List')

@section('content')
<link rel="stylesheet" href="{{asset('css/exam-list.css')}}">

<div class="container">
    <div class="card">
        <div class="card-header">
            Exam Slots
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
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Capacity</th>
                    <th>Exam Date</th>
                    <th>Duration</th>
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
                                <td>{{ $item->course_code }}</td>
                                <td>{{ $item->course_name }}</td>
                                <td>{{ $item->capacity }}</td>
                                <td>{{ $item->exam_date }}</td>
                                <td>{{ $item->duration }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->venue_short }}</td>
                                <td>{{ $item->file }}</td>
                                


 
                                <td><a href="/delete/{{ $item->id }}" class="btn btn-danger btn-sm">Delete</a></td> 
                            </tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">No Test Slots Found!</td>
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