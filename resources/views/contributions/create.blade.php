<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Contribution - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Submit Contribution'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('posts.show', $post) }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Post
        </a>
      </div>

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Submit Contribution</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $post->title }} — {{ $post->faculty->name }}</p>
      </div>

      <div
        class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200 px-4 py-3 rounded-lg flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm"><strong>Submission deadline:</strong> {{ $post->closure_date->format('d M Y') }}
          &nbsp;|&nbsp; <strong>Edit deadline:</strong>
          {{ $post->academicYear->final_closure_date->format('d M Y') }}</span>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-3xl">

        @if($errors->any())
          <div
            class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('contributions.store', $post) }}" method="POST" enctype="multipart/form-data"
          class="space-y-6" onsubmit="showUploadLoader(this)">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title') }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="4"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">{{ old('description') }}</textarea>
          </div>

          {{-- Documents Upload --}}
          <div x-data="{
              files: [],
              handleFiles(e) {
                const selected = Array.from(e.target.files);
                this.files = selected.map(f => ({
                  name: f.name,
                  size: this.formatSize(f.size),
                  ext: f.name.split('.').pop().toLowerCase()
                }));
              },
              removeFile(index) {
                this.files.splice(index, 1);
                if (this.files.length === 0) {
                  this.$refs.docInput.value = '';
                }
              },
              formatSize(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1048576).toFixed(1) + ' MB';
              }
            }">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Documents
              <span class="text-xs text-gray-400 font-normal ml-1">(Word or PDF — max 2 files, 10 MB each)</span>
            </label>

            <div
              class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-[#dc2d3d] transition-colors"
              :class="files.length > 0 ? 'p-3' : 'p-6'">
              {{-- Empty state --}}
              <div x-show="files.length === 0" class="text-center">
                <svg class="mx-auto w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Drag & drop or click to upload</p>
                <p class="text-xs text-gray-400">.doc, .docx, .pdf</p>
              </div>

              {{-- File list --}}
              <div x-show="files.length > 0" class="space-y-2">
                <template x-for="(file, index) in files" :key="index">
                  <div class="flex items-center gap-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg px-3 py-2">
                    {{-- Icon by extension --}}
                    <div class="flex-shrink-0 w-9 h-9 rounded-md flex items-center justify-center"
                      :class="file.ext === 'pdf' ? 'bg-red-100 dark:bg-red-900/30' : 'bg-blue-100 dark:bg-blue-900/30'">
                      <svg class="w-5 h-5" :class="file.ext === 'pdf' ? 'text-red-500' : 'text-blue-500'" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                      <p class="text-sm font-medium text-gray-800 dark:text-gray-100 truncate" x-text="file.name"></p>
                      <p class="text-xs text-gray-400" x-text="file.size"></p>
                    </div>
                    <button type="button" @click="removeFile(index)"
                      class="flex-shrink-0 text-gray-400 hover:text-red-500 transition-colors">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </template>

                {{-- Add more hint --}}
                <p class="text-xs text-gray-400 pt-1 text-center">Click below to change selection</p>
              </div>

              <input type="file" name="documents[]" multiple accept=".doc,.docx,.pdf" x-ref="docInput"
                @change="handleFiles($event)"
                class="mt-2 w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-[#dc2d3d] file:text-white hover:file:bg-[#b82532] cursor-pointer">
            </div>

            @error('documents')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            @error('documents.*')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          {{-- Images Upload --}}
          <div x-data="{
              previews: [],
              handleImages(e) {
                const selected = Array.from(e.target.files);
                this.previews = [];
                selected.forEach(file => {
                  const reader = new FileReader();
                  reader.onload = (ev) => {
                    this.previews.push({
                      src: ev.target.result,
                      name: file.name,
                      size: this.formatSize(file.size)
                    });
                  };
                  reader.readAsDataURL(file);
                });
              },
              removeImage(index) {
                this.previews.splice(index, 1);
                if (this.previews.length === 0) {
                  this.$refs.imgInput.value = '';
                }
              },
              formatSize(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1048576).toFixed(1) + ' MB';
              }
            }">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Images
              <span class="text-xs text-gray-400 font-normal ml-1">(JPG, PNG, GIF, WEBP — max 5 images, 5 MB
                each)</span>
            </label>

            <div
              class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-[#dc2d3d] transition-colors"
              :class="previews.length > 0 ? 'p-3' : 'p-6'">
              {{-- Empty state --}}
              <div x-show="previews.length === 0" class="text-center">
                <svg class="mx-auto w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Drag & drop or click to upload</p>
                <p class="text-xs text-gray-400">.jpg, .png, .gif, .webp</p>
              </div>

              {{-- Image grid preview --}}
              <div x-show="previews.length > 0">
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-2">
                  <template x-for="(img, index) in previews" :key="index">
                    <div class="relative group rounded-lg overflow-hidden aspect-square bg-gray-100 dark:bg-gray-700">
                      <img :src="img.src" :alt="img.name" class="w-full h-full object-cover">
                      <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-1 p-1">
                        <p class="text-white text-xs font-medium text-center truncate w-full px-1" x-text="img.name">
                        </p>
                        <p class="text-gray-300 text-xs" x-text="img.size"></p>
                        <button type="button" @click="removeImage(index)"
                          class="mt-1 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 transition-colors">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </template>
                </div>
                <p class="text-xs text-gray-400 text-center">Hover an image to remove it · Click below to change
                  selection</p>
              </div>

              <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/gif,image/webp"
                x-ref="imgInput" @change="handleImages($event)"
                class="mt-2 w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-[#dc2d3d] file:text-white hover:file:bg-[#b82532] cursor-pointer">
            </div>

            @error('images')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            @error('images.*')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div class="flex items-start gap-3">
            <input type="checkbox" name="terms_accepted" id="terms_accepted" value="1"
              class="mt-1 h-4 w-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d] cursor-pointer @error('terms_accepted') border-red-500 @enderror"
              {{ old('terms_accepted') ? 'checked' : '' }}>
            <label for="terms_accepted" class="text-sm text-gray-600 dark:text-gray-400 cursor-pointer">
              I have read and agree to the
              <button type="button" onclick="event.preventDefault(); openContribModal()"
                class="text-[#dc2d3d] font-semibold hover:underline">Contribution Terms and Conditions</button>
              <span class="text-red-500">*</span>
            </label>
          </div>
          @error('terms_accepted')<p class="text-xs text-red-500">{{ $message }}</p>@enderror

          <div class="flex gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
              Submit Contribution
            </button>
            <a href="{{ route('posts.show', $post) }}"
              class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
              Cancel
            </a>
          </div>
        </form>
      </div>

    </main>
  </div>

  {{-- Contribution Terms Modal --}}
  <div id="contrib-modal" class="fixed inset-0 hidden" style="z-index: 99999;">
    <div class="flex items-center justify-center min-h-screen px-4">
      <div class="fixed inset-0 bg-black bg-opacity-50"></div>
      <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-3xl w-full">
        <div class="bg-[#dc2d3d] px-6 py-4 flex justify-between items-center">
          <h3 class="text-xl font-bold text-white">Contribution Terms and Conditions</h3>
          <button type="button" onclick="closeContribModal()" class="text-white hover:text-gray-200">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div id="contrib-content" class="px-6 py-4 max-h-96 overflow-y-auto">
          <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">
            These <strong>Contribution Terms and Conditions</strong> govern the submission of articles and images to the
            Kingsford University Magazine. Please read carefully before submitting.
          </p>
          <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2 mt-4">1. Ownership & Originality</h3>
          <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc list-inside mb-3 space-y-1 ml-2">
            <li>You confirm that all submitted content is your own original work.</li>
            <li>You have not plagiarised or reproduced content from any third-party source without proper attribution.
            </li>
            <li>You are solely responsible for ensuring the accuracy and integrity of your submission.</li>
          </ul>
          <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2 mt-4">2. Intellectual Property</h3>
          <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc list-inside mb-3 space-y-1 ml-2">
            <li>By submitting, you grant Kingsford University a non-exclusive right to publish your contribution in the
              annual magazine.</li>
            <li>You retain ownership of your work; however, you may not withdraw consent after the final closure date.
            </li>
            <li>You confirm your submission does not infringe on any third-party copyright, trademark, or intellectual
              property rights.</li>
          </ul>
          <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2 mt-4">3. Content Standards</h3>
          <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc list-inside mb-3 space-y-1 ml-2">
            <li>Content must not contain offensive, discriminatory, defamatory, or inappropriate material.</li>
            <li>Images must be high quality and must not include private or identifiable individuals without their
              consent.</li>
            <li>Content must comply with all applicable university policies and codes of conduct.</li>
          </ul>
          <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2 mt-4">4. Review & Publication</h3>
          <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc list-inside mb-3 space-y-1 ml-2">
            <li>All submissions are subject to review by your Faculty's Marketing Coordinator.</li>
            <li>The Coordinator may approve, reject, or request changes to your contribution.</li>
            <li>Selected contributions will be included in the university magazine at the discretion of the Marketing
              Manager.</li>
          </ul>
          <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2 mt-4">5. Deadlines</h3>
          <ul class="text-sm text-gray-700 dark:text-gray-300 list-disc list-inside mb-3 space-y-1 ml-2">
            <li>New submissions are only accepted before the post closure date.</li>
            <li>Edits to existing submissions are allowed until the final closure date of the academic year.</li>
            <li>Late submissions will not be accepted under any circumstances.</li>
          </ul>
          <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <p class="text-sm text-blue-900 dark:text-blue-200 font-medium">
              By clicking "I Agree", you confirm that you have read, understood, and agree to these terms.
              Non-compliance may result in removal of your contribution.
            </p>
          </div>
        </div>
        <div class="px-6 py-4 flex justify-between bg-gray-50 dark:bg-gray-700/50 rounded-b-lg">
          <button type="button" onclick="closeContribModal()"
            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
            Decline
          </button>
          <button type="button" id="contrib-agree" onclick="agreeContribTerms()"
            class="px-6 py-2 bg-[#dc2d3d] text-white rounded hover:bg-[#b82532]">
            I Agree
          </button>
        </div>
      </div>
    </div>
  </div>

  @include('components.upload-loading')

  @include('components.dashboard_scripts')

  <script>
    function openContribModal() {
      document.getElementById('contrib-modal').classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    }

    function closeContribModal() {
      document.getElementById('contrib-modal').classList.add('hidden');
      document.body.style.overflow = '';
    }

    function agreeContribTerms() {
      document.getElementById('terms_accepted').checked = true;
      closeContribModal();
    }
  </script>
</body>

</html>