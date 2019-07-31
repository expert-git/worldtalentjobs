<div id="skdiv_{{$skillset->id}}"  @if($skillset->id==0) class="collapse" @endif>

    <form action="/jobseeker/updateSkillset" method="POST" id="skillset_form_{{$skillset->id}}"  data-id="{{$skillset->id}}">
    {{ csrf_field() }}
    
        <input type="hidden" id="{{$skillset->id}}skillset_id" name="skillset_id" value="{{$skillset->id}}"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="skillset">
                        
                    <input required type="text" id="{{$skillset->id}}title" name="title" placeholder="Skill title eg: PHP Frameworks" value={{$skillset->title}}>
                    @if($skillset->id!=0)
                    <button class="skillset removebtn" type="button" onclick="removeskillset({{$skillset->id}})">Remove</button>
                    @endif
                    <button class="skillset savebtn" type="submit">
                        @if($skillset->id!=0)
                            Save
                        @else
                            Add
                        @endif
                    </button>
                    <hr>
                    <textarea required name="skill" id="{{$skillset->id}}skill" rows="3" placeholder="type new skills here">{{$skillset->skill}}</textarea>
                </div>
            </div>
        </div>
    </form>
</div>
