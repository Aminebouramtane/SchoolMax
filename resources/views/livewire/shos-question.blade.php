<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">{{$data[$counter]->title}}</h4>
                </div>
            </div>
            <div class="card-body">
                @foreach (preg_split('/(-)/',$data[$counter]->answers) as $index => $answer)
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customRadio{{$index}}" name="customRadio">
                        <label for="customRadio{{$index}}" class="custom-control-label" wire:click="nextQuestion({{$data[$counter]->id}},{{$data[$counter]->score}},'{{$answer}}','{{$data[$counter]->right_answer}}')">{{$answer}}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

