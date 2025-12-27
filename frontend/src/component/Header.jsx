import React from 'react'
import { Link } from 'react-router-dom'

const Header = () => {
  return (
    <div>

    {/*===== HEADER =====*/}
<header className="l-header">
  <nav className="nav bd-grid">
    <div>
      <a href="#" className="nav__logo">Marlon</a>
    </div>
    <div className="nav__menu" id="nav-menu">
      <ul className="nav__list">
        <li className="nav__item"><Link  className="nav__link active-link" to={'/'}>Home</Link></li>
        <li className="nav__item"><a href="#about" className="nav__link">About</a></li>
        <li className="nav__item"><a href="#skills" className="nav__link">Skills</a></li>
        <li className="nav__item"><a href="#work" className="nav__link">Work</a></li>
        <li className="nav__item"><a href="#contact" className="nav__link">Contact</a></li>
      </ul>
    </div>
    <div className="nav__toggle" id="nav-toggle">
      <i className="bx bx-menu" />
    </div>
  </nav>
</header>

      
    </div>
  )
}

export default Header
