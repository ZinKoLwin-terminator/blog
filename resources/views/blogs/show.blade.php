

<x-layout>
    <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto text-center">
            <img
              src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
              class="card-img-top"
              alt="..."
            />
            <h3 class="my-3">{{$blog->title}}</h3>
            <div>
                <div>Author-
                    <a href="/users/{{$blog->author->username}}">
                        {{$blog->author->name}}
                    </a>
                </div>
                <div class="my-3">
                    <a href="/categories/{{$blog->category->slug}}">
                        <span class="badge bg-primary">{{$blog->category->name}}</span>
                    </a>
                </div>
                <div class="text-secondary">{{$blog->created_at->diffForHumans()}}</div>
            </div>
            <p class="lh-md mt-3" >
            {{$blog->body}}
            </p>
          </div>
        </div>
      </div>
      <section class="container">
        <div class="col-md-8 mx-auto">
          <x-card-wrapper class="bg-secondary">
            <form>
                <div class="mb-3">

                  <textarea name="" id="" cols="30" class="form-control border border-0" rows="10" placeholder="saysomething..."></textarea>

                </div>

               <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
               </div>
              </form>

          </x-card-wrapper>


        </div>
    </section>
      <x-comments :comments="$blog->comments" />
     <x-subscribe />
     <x-blogs_you_may_like :randomBlogs="$randomBlogs" />
</x-layout>

