<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>CRM</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
{{--    @can('admin')--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fas-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('users.index')}}">All users</a>
                <a class="collapse-item" href="{{route('users.index2')}}">All users blade</a>
                <a class="collapse-item" href="{{route('users.create')}}">Add user</a>
            </div>
        </div>
    </li>
{{--    @endcan--}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePosts"
           aria-expanded="true" aria-controls="collapsePosts">
            <i class="fas fa-blog"></i>
            <span>Posts</span>
        </a>
        <div id="collapsePosts" class="collapse" aria-labelledby="collapsePosts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('posts.index')}}">All posts</a>
                <a class="collapse-item" href="{{route('posts.create')}}">Create post</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories"
           aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-hashtag"></i>
            <span>Categories</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="collapseCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('categories.index')}}">All Categories</a>
                <a class="collapse-item" href="{{route('categories.create')}}">Create Category</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseComments"
           aria-expanded="true" aria-controls="collapseComments">
            <i class="fas fa-comment"></i>
            <span>Comments</span>
        </a>
        <div id="collapseComments" class="collapse" aria-labelledby="collapseComments" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('comments.index')}}">All Comments</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-shopping-bag"></i>
            <span>E-COMMERCE</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
           aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-shopping-cart"></i>
            <span>Products</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="collapseProducts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('products.index')}}">All products</a>
                <a class="collapse-item" href="{{route('products.create')}}">Create Product</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBrands"
           aria-expanded="true" aria-controls="collapseBrands">
            <i class="fas fa-tags"></i>
            <span>Brands</span>
        </a>
        <div id="collapseBrands" class="collapse" aria-labelledby="collapseBrands" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('brands.index')}}">All brands</a>
                <a class="collapse-item" href="{{route('brands.create')}}">Create Brand</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductcategories"
           aria-expanded="true" aria-controls="collapseProductcategories">
            <i class="fas fa-tint"></i>
            <span>Product Categories</span>
        </a>
        <div id="collapseProductcategories" class="collapse" aria-labelledby="collapseProductcategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('productcategories.index')}}">All Product Categories</a>
                <a class="collapse-item" href="{{route('productcategories.create')}}">Create Product Category</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBoxes"
           aria-expanded="true" aria-controls="collapseBoxes">
            <i class="fas fa-box"></i>
            <span>Boxes</span>
        </a>
        <div id="collapseBoxes" class="collapse" aria-labelledby="collapseBoxes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('boxes.index')}}">All boxes</a>
                <a class="collapse-item" href="{{route('boxes.create')}}">Create Box</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCards"
           aria-expanded="true" aria-controls="collapseCards">
            <i class="fas fa-square-full"></i>
            <span>Cards</span>
        </a>
        <div id="collapseCards" class="collapse" aria-labelledby="collapseCards" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('cards.index')}}">All Cards</a>
                <a class="collapse-item" href="{{route('cards.create')}}">Create Card</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonsterTypes"
           aria-expanded="true" aria-controls="collapseMonsterTypes">
            <i class="fas fa-feather"></i>
            <span>MonsterType</span>
        </a>
        <div id="collapseMonsterTypes" class="collapse" aria-labelledby="collapseMonsterTypes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('monstertype.index')}}">All Monster Types</a>
                <a class="collapse-item" href="{{route('monstertype.create')}}">Create Monster Type</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonsterSpecialTypes"
           aria-expanded="true" aria-controls="collapseMonsterSpecialTypes">
            <i class="fas fa-feather-alt"></i>
            <span>MonsterSpecialType</span>
        </a>
        <div id="collapseMonsterSpecialTypes" class="collapse" aria-labelledby="collapseMonsterSpecialTypes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('monsterspecialtype.index')}}">All Monster Special Types</a>
                <a class="collapse-item" href="{{route('monsterspecialtype.create')}}">Create Monster Special Type</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonsterAttribute"
           aria-expanded="true" aria-controls="collapseMonsterAttribute">
            <i class="fas fa-bolt"></i>
            <span>MonsterAttribute</span>
        </a>
        <div id="collapseMonsterAttribute" class="collapse" aria-labelledby="collapseMonsterAttribute" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('monsterattribute.index')}}">All Monster Attribute</a>
                <a class="collapse-item" href="{{route('monsterattribute.create')}}">Create Monster Attribute</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonsterClass"
           aria-expanded="true" aria-controls="collapseMonsterClass">
            <i class="fas fa-paw"></i>
            <span>MonsterClass</span>
        </a>
        <div id="collapseMonsterClass" class="collapse" aria-labelledby="collapseMonsterClass" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('monsterclass.index')}}">All Monster Classes</a>
                <a class="collapse-item" href="{{route('monsterclass.create')}}">Create Monster Class</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSpellType"
           aria-expanded="true" aria-controls="collapseSpellType">
            <i class="fas fa-magic"></i>
            <span>SpellType</span>
        </a>
        <div id="collapseSpellType" class="collapse" aria-labelledby="collapseSpellType" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('spelltype.index')}}">All Spell Types</a>
                <a class="collapse-item" href="{{route('spelltype.create')}}">Create Spell Type</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrapType"
           aria-expanded="true" aria-controls="collapseTrapType">
            <i class="fas fa-ring"></i>
            <span>TrapType</span>
        </a>
        <div id="collapseTrapType" class="collapse" aria-labelledby="collapseTrapType" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('traptype.index')}}">All Trap Types</a>
                <a class="collapse-item" href="{{route('traptype.create')}}">Create Trap Type</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCardType"
           aria-expanded="true" aria-controls="collapseCardType">
            <i class="fas fa-laptop-house"></i>
            <span>CardType</span>
        </a>
        <div id="collapseCardType" class="collapse" aria-labelledby="collapseCardType" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Links:</h6>
                <a class="collapse-item" href="{{route('cardtype.index')}}">All Card Types</a>
                <a class="collapse-item" href="{{route('cardtype.create')}}">Create Card Type</a>
            </div>
        </div>
    </li>
</ul>
