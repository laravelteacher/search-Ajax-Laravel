<div id="load" style="position: relative;" class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">type</th>
            <th scope="col">Amount</th>
            <th scope="col">Category</th>
            <th scope="col">mode</th>
            <th scope="col">note</th>
            <th scope="col">date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)  
            <tr>
               
                <td>{{ ucwords($student->type) }}</td>
                <td>{{ ucwords($student->amount) }}</td>
                <td>{{ ucwords($student->category) }}</td>
                <td>{{ ucwords($student->mode) }}</td>
                <td>{{ ucwords($student->note) }}</td>
                <td>{{ ucwords($student->date) }}</td>
                <td>  
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>  

{!! $students->render() !!}
{{ $students->links() }}
 
