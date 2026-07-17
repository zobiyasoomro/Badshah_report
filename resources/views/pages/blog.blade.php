@extends('layouts.master')

@section('content')
   @include('components.pagesbanner', [
        'banner_title' => 'Blogs',
        'banner_button_text' => 'Our Latest Blogs',
        'banner_button_url' => 'We\'re Here to Help',
        'banner_description' => 'Have questions, feedback, or want to talk with us? Our team is ready to assist you anytime.'
    ])
   

<style>
  /* ===== BLOG PAGE UNIQUE STYLES (prefix: blog-) ===== */
  :root{
    --blog-bg: #233b56;
    --blog-bg2: #0a1626;
    --blog-panel: #0d1f30;
    --blog-cyan: #37e6f0;
    --blog-cyan-dim: #1c8f96;
    --blog-text: #cfe9ee;
    --blog-text-dim: #7fa6ac;
    --blog-border: rgba(55,230,240,0.35);
  }
  
  .blog-wrapper *{box-sizing:border-box;}
  
  .blog-wrapper {
    margin:0;
    background: radial-gradient(circle at 50% 0%, #0d2436 0%, var(--blog-bg) 60%);
    font-family: 'Segoe UI', Arial, sans-serif;
    color: var(--blog-text);
    padding: 50px 20px;
  }
  
  .blog-heading{
    text-align:center;
    margin-bottom: 40px;
  }
  .blog-heading h1{
    font-size: 28px;
    letter-spacing: 3px;
    font-weight: 700;
    margin:0;
    color:#fff;
  }
  .blog-heading h1 span{color:var(--blog-cyan);}
  .blog-heading p{color:var(--blog-text-dim); font-size:13px; margin-top:8px;}

  .blog-grid{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    max-width: 1200px;
    margin: 0 auto;
  }

  @media (max-width: 1024px){
    .blog-grid{grid-template-columns: repeat(2, 1fr);}
  }
  @media (max-width: 620px){
    .blog-grid{grid-template-columns: 1fr;}
  }
  @media (max-width: 400px){
    .blog-wrapper{padding: 30px 12px;}
    .blog-heading h1{font-size: 20px; letter-spacing: 1.5px;}
    .blog-grid{gap: 16px;}
    .blog-card-body{padding: 14px 16px 16px;}
    .blog-card h3{font-size: 14px;}
    .blog-desc{font-size: 12px;}
    .blog-read-more{font-size: 11px; padding: 5px 12px;}
    .blog-modal{padding: 32px 20px 24px;}
    .blog-modal-close{top: 10px; right: 12px; font-size: 18px;}
  }

  .blog-card{
    background: linear-gradient(180deg, var(--blog-panel), #081420);
    border: 1px solid var(--blog-border);
    border-radius: 6px;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    box-shadow: 0 0 25px rgba(55,230,240,0.06);
    transition: box-shadow .25s ease, transform .25s ease;
  }
  .blog-card:hover{
    box-shadow: 0 0 30px rgba(55,230,240,0.25);
    transform: translateY(-3px);
  }
  .blog-card img{
    width:100%;
    height:170px;
    object-fit:cover;
    display:block;
  }
  .blog-card-body{
    padding: 18px 20px 20px;
    display:flex;
    flex-direction:column;
    flex:1;
  }
  .blog-card h3{
    font-size:16px;
    margin:0 0 10px;
    color:#fff;
    line-height:1.4;
  }
  .blog-desc{
    font-size:13px;
    color: var(--blog-text-dim);
    line-height:1.5;
    margin:0;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient: vertical;
    overflow:hidden;
  }
  .blog-card-footer{
    margin-top:14px;
    display:flex;
    justify-content:flex-end;
  }
  .blog-read-more{
    background:transparent;
    border:1px solid var(--blog-cyan-dim);
    color:var(--blog-cyan);
    font-size:12px;
    padding:6px 14px;
    border-radius:3px;
    cursor:pointer;
    letter-spacing:0.5px;
    transition: all .2s ease;
  }
  .blog-read-more:hover{
    background: var(--blog-cyan);
    color:#04141a;
    border-color: var(--blog-cyan);
  }

  /* ===== BLOG MODAL - FULLY RESPONSIVE WITH SCROLLING ===== */
  .blog-overlay{
    position:fixed;
    inset:0;
    background: rgba(2,8,14,0.92);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:99999;
    padding:20px;
    backdrop-filter: blur(8px);
    overflow-y:auto;
    -webkit-overflow-scrolling: touch;
  }
  
  .blog-overlay.active{
    display:flex;
  }
  
  .blog-modal{
    background: var(--blog-bg2);
    border:1px solid var(--blog-border);
    border-radius:12px;
    max-width:650px;
    width:100%;
    max-height:90vh;
    padding:36px 32px 32px;
    position:relative;
    box-shadow: 0 0 60px rgba(55,230,240,0.12);
    animation: blogModalFadeIn 0.3s ease;
    overflow-y:auto;
    -webkit-overflow-scrolling: touch;
    display:flex;
    flex-direction:column;
  }

  /* Custom scrollbar for modal */
  .blog-modal::-webkit-scrollbar {
    width: 6px;
  }
  
  .blog-modal::-webkit-scrollbar-track {
    background: rgba(55,230,240,0.05);
    border-radius: 10px;
  }
  
  .blog-modal::-webkit-scrollbar-thumb {
    background: var(--blog-cyan-dim);
    border-radius: 10px;
  }
  
  .blog-modal::-webkit-scrollbar-thumb:hover {
    background: var(--blog-cyan);
  }

  @keyframes blogModalFadeIn {
    from {
      opacity: 0;
      transform: scale(0.92) translateY(30px);
    }
    to {
      opacity: 1;
      transform: scale(1) translateY(0);
    }
  }
  
  .blog-modal h3{
    color:#fff;
    font-size:22px;
    margin:0 0 12px 0;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--blog-border);
    line-height:1.3;
    padding-right: 40px;
  }
  
  .blog-modal .modal-content {
    flex: 1;
    overflow-y: auto;
    padding-right: 4px;
  }
  
  .blog-modal p{
    color:var(--blog-text);
    font-size:15px;
    line-height:1.9;
    margin:0;
    white-space:pre-wrap;
    word-wrap:break-word;
  }
  
  .blog-modal-close{
    position:absolute;
    top:14px;
    right:16px;
    background: rgba(55,230,240,0.1);
    border: 1px solid var(--blog-border);
    color:var(--blog-cyan);
    font-size:18px;
    width:38px;
    height:38px;
    border-radius:50%;
    cursor:pointer;
    transition: all 0.3s ease;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
    z-index:10;
  }
  
  .blog-modal-close:hover{
    background: var(--blog-cyan);
    color: #04141a;
    transform: rotate(90deg);
  }
  
  .no-blogs {
    text-align: center;
    padding: 60px 20px;
    grid-column: 1 / -1;
  }
  
  .no-blogs h3 {
    color: #fff;
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .no-blogs p {
    color: var(--blog-text-dim);
    font-size: 16px;
  }

  /* ===== RESPONSIVE MODAL ===== */
  @media (max-width: 768px) {
    .blog-modal {
      max-width: 95%;
      max-height: 85vh;
      padding: 28px 20px 20px;
      border-radius: 10px;
    }
    
    .blog-modal h3 {
      font-size: 18px;
      padding-right: 35px;
      padding-bottom: 12px;
    }
    
    .blog-modal p {
      font-size: 14px;
      line-height: 1.8;
    }
    
    .blog-modal-close {
      width: 34px;
      height: 34px;
      font-size: 16px;
      top: 12px;
      right: 12px;
    }
  }

  @media (max-width: 480px) {
    .blog-overlay {
      padding: 10px;
    }
    
    .blog-modal {
      max-width: 100%;
      max-height: 90vh;
      padding: 24px 16px 16px;
      border-radius: 8px;
    }
    
    .blog-modal h3 {
      font-size: 16px;
      padding-right: 30px;
      padding-bottom: 10px;
    }
    
    .blog-modal p {
      font-size: 13px;
      line-height: 1.7;
    }
    
    .blog-modal-close {
      width: 30px;
      height: 30px;
      font-size: 14px;
      top: 10px;
      right: 10px;
    }
  }

  @media (max-height: 500px) {
    .blog-modal {
      max-height: 95vh;
      padding: 20px 16px 16px;
    }
    
    .blog-modal h3 {
      font-size: 16px;
      padding-bottom: 8px;
      margin-bottom: 8px;
    }
    
    .blog-modal p {
      font-size: 13px;
      line-height: 1.6;
    }
    
    .blog-modal-close {
      width: 28px;
      height: 28px;
      font-size: 13px;
      top: 8px;
      right: 8px;
    }
  }
</style>


<div class="blog-wrapper">

  <div class="blog-heading">
    <h1>FEATURED <span>TRANSMISSIONS</span></h1>
    <p>BetPro Exchange is set to transform the industry with cutting-edge odds.</p>
  </div>

  <div class="blog-grid">
    @forelse($blogs as $blog)
      <!-- ===== BLOG CARD ===== -->
      <div class="blog-card">
        <img src="{{ $blog->image ? asset('blogs/' . $blog->image) : 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&q=80' }}" alt="{{ $blog->title }}">
        <div class="blog-card-body">
          <h3>{{ $blog->title }}</h3>
          <p class="blog-desc" data-fulltext="{{ $blog->description }}">
            {{ Str::limit($blog->description, 120) }}
          </p>
          <div class="blog-card-footer">
            <button class="blog-read-more" onclick="blogOpenModal('{{ addslashes($blog->title) }}', this)">Read More</button>
          </div>
        </div>
      </div>
    @empty
      <div class="no-blogs">
        <h3>No Blogs Found</h3>
        <p>Check back later for new content!</p>
      </div>
    @endforelse
  </div>

  <!-- ===== BLOG MODAL (UNIQUE IDS) ===== -->
  <div class="blog-overlay" id="blogOverlay">
    <div class="blog-modal" id="blogModal">
      <button class="blog-modal-close" onclick="blogCloseModal()">✕</button>
      <h3 id="blogModalTitle"></h3>
      <div class="modal-content">
        <p id="blogModalDesc"></p>
      </div>
    </div>
  </div>

</div>

<script>
  function blogOpenModal(title, buttonElement){
    // Get the parent blog-card-body
    var cardBody = buttonElement.closest('.blog-card-body');
    // Find the description paragraph inside
    var descElement = cardBody.querySelector('.blog-desc');
    // Get the full text from data attribute
    var fullDescription = descElement.getAttribute('data-fulltext');
    
    // Set modal content
    document.getElementById('blogModalTitle').textContent = title;
    document.getElementById('blogModalDesc').textContent = fullDescription;
    document.getElementById('blogOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Reset scroll position of modal
    var modal = document.getElementById('blogModal');
    if (modal) {
      modal.scrollTop = 0;
    }
  }
  
  function blogCloseModal(){
    document.getElementById('blogOverlay').classList.remove('active');
    document.body.style.overflow = '';
  }
  
  // Close modal when clicking outside
  document.getElementById('blogOverlay').addEventListener('click', function(e){
    if(e.target === this) blogCloseModal();
  });
  
  // Close modal on Escape key
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape') blogCloseModal();
  });
</script>

@endsection